<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionController extends Controller
{
    public function index(){
        $regions = Region::all();
        return view('region.index')->with([
            'regions' => $regions
        ]);
    }

    public function create(){
        $regions = Region::all();
        return view('region.create')->with([
            'regions' => $regions
        ]);
    }

    public function edit($id){
        $regions = Region::all();
        try {
            $region = Region::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        return view('region.edit')->with([
            'region' => $region,
            'regions' => $regions
        ]);
    }

    public function delete($id){
        try {
            Region::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'This Region is used by some people. try to delete people first'
            ]);
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Region removed successfully'
        ]);
    }

    public function submit(Request $req){
        $req->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'parentId' => 'nullable|integer'
        ]);

        $region = new Region;
        $region->name = $req->name;
        $region->type = $req->type;
        $region->parent_id = $req->parentId;
        $region->save();

        
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Region added successfully'
        ]);
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'parentId' => 'nullable|integer',
            'regionId' => 'required|integer'
        ]);

        try {
            $region = Region::findOrFail($req->regionId);
            $region->name = $req->name;
            $region->type = $req->type;
            $region->parent_id = $req->parentId;
            $region->save();
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Region updated successfully'
        ]);
    }

    public function find($id){
        try {
            $region = Region::with('Childs')->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => '404 Not found'
            ], 404);
        }

        return response()->json($region, 200);
    }

}
