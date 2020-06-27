<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Person;
use App\PersonRegion;

class PersonController extends Controller
{
    public function getAllPeople(){
        $people = Person::all();
        return response()->json($people, 200);
    }
    public function findPerson($id){
        try {
            $person = Person::findOrFail($id);
            $personRegion = PersonRegion::with('Region')->where('person_id', $id)->first();
            $person['rank'] = $personRegion->rank;
            $person['region'] = $personRegion->Region;

        } catch (\Throwable $th) {
            // dd($th);
            return response()->json([
                'message' => 'Not found!'
            ], 404);
        }
        return response()->json($person, 200);
    }
}
