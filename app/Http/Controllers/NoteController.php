<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class NoteController extends Controller
{
    function save(Request $request) {

        $requestData = Notes::create($request->all());

        return response()->json([
            "status" => "ok",
            "message" => "Succesfully saved notes",
            "data" => $requestData
        ]);
    }

    function single($id) {
        $specificItem = Notes::find($id);

        if ($specificItem) {
            return response()->json([
                "status" => "ok",
                "message" => "Here is your requested specific data.",
                "data" => $specificItem
            ]);
        } else {
            return response()->json([
                "status" => "err",
                "message" => "We cannot find your requested data."
            ]);
        }
    }

    function view() {
        $data = Notes::all();

        return response()->json([
            "status"=> "ok",
            "message"=> "Here is your requested data",
            "data"=> $data
        ]);
    }
}
