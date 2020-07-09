<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Committee;

class CommitteeController extends Controller
{
    public function index(){
        $committees = Committee::all();
        return view('committee.index')->with([
            'committees' => $committees
        ]);
    }

    public function create(){
        return view('committee.create');
    }

    public function edit($id){
        try {
            $committee = Committee::findOrFail($id);
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        return view('committee.edit')->with([
            'committee' => $committee
        ]);
    }

    public function delete($id){
        try {
            Committee::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'This Committee is used by some people. try to delete people first'
            ]);
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Committee removed successfully'
        ]);
    }

    public function submit(Request $req){
        $req->validate([
            'name' => 'required|string'
        ]);

        $committee = new Committee;
        $committee->name = $req->name;
        $committee->save();

        
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Committee added successfully'
        ]);
    }

    public function update(Request $req){
        $req->validate([
            'name' => 'required|string',
            'committeeId' => 'required|integer'
        ]);

        try {
            $committee = Committee::findOrFail($req->committeeId);
            $committee->name = $req->name;
            $committee->save();
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Committee updated successfully'
        ]);
    }

    // public function find($id){
    //     try {
    //         $committee = Committee::with('Childs')->findOrFail($id);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'message' => '404 Not found'
    //         ], 404);
    //     }

    //     return response()->json($committee, 200);
    // }

    //
}
