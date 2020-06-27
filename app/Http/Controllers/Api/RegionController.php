<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Region;

class RegionController extends Controller
{
    public function getAllRegions(){
        $regions = Region::all();
        return response()->json($regions, 200);
    }

    public function findRegion($id){
        try {
            $region = Region::with('Parent')
                            ->with('Childs')
                            ->findOrFail($id);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'message' => 'Not found'
            ], 404);
        }
        return response()->json($region, 200);
    }
}
