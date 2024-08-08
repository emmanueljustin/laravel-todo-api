<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::all();

        if ($data->isEmpty()) {
            return response()->json([
                "status" => "ok",
                "message" => "There is no existing TODO data."
            ]);
        }

        return response()->json([
            "status" => "ok",
            "message" => "This is all of the todos.",
            "data" => $data
        ]);
    }

    public function store(TodoRequest $payload)
    {
        $result = Todo::create($payload->all());

        return response()->json([
            "status" => "ok",
            "message" => "Succesfully saved TODO.",
            "data" => $result
        ]);
    }

    public function update(TodoRequest $payload, string $id)
    {
        $post = Todo::find($id);

        if (!$post) {
            return response()->json([
                "status" => "err",
                "message" => "The file that you are modifying does not exist."
            ]);
        }

        $post->update($payload->all());

        return response()->json([
            "status" => "ok",
            "message" => "Your Todo is updated successfully.",
            "data" => $post
        ]);
    }

    // function saveTodo(Request $payload) {
    //     $result = Todo::create($payload->all());

    //     return response()->json([
    //         "status" => "ok",
    //         "message" => "Succesfully saved TODO.",
    //         "data" => $result
    //     ]);
    // }

    // function getTodos() {
    //     $data = Todo::all();

    //     return response()->json([
    //         "status" => "ok",
    //         "message" => "This is all of the todos.",
    //         "data" => $data
    //     ]);
    // }

    // function updateTodos(Request $payload) {
    //     $post = Todo::find($payload->id);

    //     if (!$post) {
    //         return response()->json([
    //             "status" => "err",
    //             "message" => "The file that you are modifying does not exist."
    //         ]);
    //     }

    //     $post->update($payload->all());

    //     return response()->json([
    //         "status" => "ok",
    //         "message" => "Your Todo is updated successfully.",
    //         "data" => $post
    //     ]);
    // }

    function deleteTodos(Request $payload) {

        $ids = $payload->input("ids");

        Todo::whereIn("id", $ids)->delete();

        return response()->json([
            "status" => "ok",
            "message" => "Selected todo deleted succesfully."
        ]);
    }
}
