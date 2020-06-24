<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Region;
use App\PersonRegion;
use DB;

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
        return view('person.create')->with([
            'regions' => $regions
        ]);
    }

    public function edit($id){
        $regions = Region::where('parent_id', null)->get();
        try {
            $person = Person::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        return view('person.edit')->with([
            'person' => $person,
            'regions' => $regions
        ]);
    }

    public function delete($id){
        try {
            Person::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'This Person is used by some people. try to delete people first'
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
            'cnic' => 'unique:people|string|required',
            'phone_no' => 'unique:people|string|required',
            'na_no' => 'string|required',
            'address' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $person = new Person;
            $person->name = $req->name;
            $person->father_name = $req->fatherName;
            // $person->region_id = $req->regionId;
            $person->cnic = $req->cnic;
            $person->phone_no = $req->phone_no;
            $person->na_no = $req->na_no;
            $person->address = $req->address;
            $person->save();

            $personRegion = new PersonRegion;
            $personRegion->person_id = $person->id;
            $personRegion->region_id = $req->regionId;
            $personRegion->save();

        
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollback();
            abort(500);
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
            // 'regionId' => 'required|integer',
            'cnic' => 'string|required',
            'phone_no' => 'string|required',
            'na_no' => 'string|required',
            'address' => 'nullable|string',
            'personId' => 'required|integer'
        ]);
        DB::beginTransaction();
        try {
            $person = Person::findOrFail($req->personId);
            $person->name = $req->name;
            $person->father_name = $req->fatherName;
            // $person->region_id = $req->regionId;
            $person->cnic = $req->cnic;
            $person->phone_no = $req->phone_no;
            $person->na_no = $req->na_no;
            $person->address = $req->address;
            $person->save();

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
