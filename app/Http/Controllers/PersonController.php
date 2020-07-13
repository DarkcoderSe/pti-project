<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Region;
use App\PersonRegion;
use App\Committee;
use DB;
use File;

class PersonController extends Controller
{
    public function index(){
        $persons = Person::all();
        return view('person.index')->with([
            'persons' => $persons
        ]);
    }

    public function create(){
        $regions = Region::where('parent_id', null)->get();
        $committees = Committee::all();
        return view('person.create')->with([
            'regions' => $regions,
            'committees' => $committees
        ]);
    }

    public function edit($id){
        try {
            $person = Person::findOrFail($id);
            // dd($person->Regions->first());
            $committees = Committee::all();
            $regions = Region::where('type', $person->Regions->first()->Region->type)->get();
            $parentRegions = Region::where('parent_id', null)->get();

        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        


        return view('person.edit')->with([
            'person' => $person,
            'regions' => $regions,
            'parentRegions' => $parentRegions,
            'committees' => $committees
        ]);
    }

    public function delete($id){
        try {
            Person::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'This Person is ranked at some regions. Please delete those region first'
            ]);
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Person removed successfully'
        ]);
    }

    public function submit(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string',
            'fatherName' => 'nullable|string',
            'regionId' => 'required|integer',
            // 'cnic' => 'unique:people|string|required',
            'phone_no' => 'unique:people|string|required',
            // 'na_no' => 'string|required',
            // 'address' => 'nullable|string',
            'rank' => 'required|string',
            'education' => 'nullable|string',
            'fb_link' => 'nullable|string',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer',
            'committee_id' => 'required|integer',
            'picture' => 'nullable|mimes:jpg,png,jpeg'
        ]);

        DB::beginTransaction();

        try {
            $person = new Person;
            $person->name = $req->name;
            $person->father_name = $req->fatherName;
            // $person->region_id = $req->regionId;
            // $person->cnic = $req->cnic;
            $person->phone_no = $req->phone_no;
            // $person->na_no = $req->na_no;
            $person->fb_link = $req->fb_link;
            $person->education = $req->education;
            $person->dob = $req->dob;
            $person->age = $req->age;
            $person->committee_id = $req->committee_id;
            // $person->address = $req->address;
            $person->political_profile = $req->political_profile;
            if ($req->hasFile('picture')) {


                $image = $req->file('picture');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/profile_pictures');
                $image->move($destinationPath, $name);
                $person->picture = $name;
            }
            $person->save();

            $personRegion = new PersonRegion;
            $personRegion->person_id = $person->id;
            $personRegion->region_id = $req->regionId;
            $personRegion->rank = $req->rank;
            $personRegion->save();
        
        } catch (\Throwable $th) {
            dd($th);
            // DB::rollback();
            // abort(500);
        }

        DB::commit();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Person added successfully'
        ]);
    }

    public function update(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string',
            'fatherName' => 'nullable|string',
            'regionId' => 'required|integer',
            // 'cnic' => 'string|required',
            'phone_no' => 'string|required',
            // 'na_no' => 'string|required',
            // 'address' => 'nullable|string',
            'personId' => 'required|integer',
            'education' => 'nullable|string',
            'fb_link' => 'nullable|string',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer',
            'committee_id' => 'required|integer',
            'picture' => 'nullable|mimes:jpg,png,jpeg'
        ]);
        DB::beginTransaction();
        try {
            $person = Person::findOrFail($req->personId);
            $person->name = $req->name;
            $person->father_name = $req->fatherName;
            // $person->region_id = $req->regionId;
            // $person->cnic = $req->cnic;
            $person->phone_no = $req->phone_no;
            // $person->na_no = $req->na_no;
            // $person->address = $req->address;
            $person->education = $req->education;
            $person->dob = $req->dob;
            $person->age = $req->age;
            $person->committee_id = $req->committee_id;
            $person->fb_link = $req->fb_link;
            $person->political_profile = $req->political_profile;
            if ($req->hasFile('picture')) {

                $deleteOldImagePath = "profile_pictures/" . $person->picture;
                if(File::exists($deleteOldImagePath)){
                    File::delete($deleteOldImagePath);
                }
    
                $image = $req->file('picture');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/profile_pictures');
                $image->move($destinationPath, $name);
                $person->picture = $name;
            }

            $person->save();

            $personRegion = PersonRegion::where('person_id', $person->id)->first();
            $personRegion->region_id = $req->regionId;
            $personRegion->save();

        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            abort(404);
        }

        
        DB::commit();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Person updated successfully'
        ]);
    }

}
