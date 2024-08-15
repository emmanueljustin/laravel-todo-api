<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{

    protected $todoService;

    /**
     * Constructor for initializing TodoService and it's methods. 
     */
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Fetch all existing todo data in database.
     */
    public function index() : JsonResponse
    {
        $data = $this->todoService->getAll();

        if ($data->isEmpty()) {
            return response()->json([
                "status" => "ok",
                "message" => "There is no existing TODO data.",
                "data" => []
            ]);
        }

        return response()->json([
            "status" => "ok",
            "message" => "This is all of the todos.",
            "data" => $data
        ]);
    }

    /**
     * Create table and store data based from request sent or save request from existing database table.
     */
    public function store(TodoRequest $payload) : JsonResponse
    {
        $result = $this->todoService->create($payload->all());

        return response()->json([
            "status" => "ok",
            "message" => "Succesfully saved TODO.",
            "data" => $result
        ]);
    }

    /**
     * Update existing todo in your database based on id given.
     */
    public function update(TodoRequest $payload, string $id) : JsonResponse
    {
        $post = $this->todoService->updateData($payload->all(), $id);

        if (!$post) {
            return response()->json([
                "status" => "err",
                "message" => "The file that you are modifying does not exist."
            ]);
        }

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

    /** 
     * Delete todo item/items.
    */
    function deleteTodos(Request $payload) : JsonResponse
    {

        $ids = $payload->ids;

        $result = $this->todoService->batchDelete($ids);

        if (!$result) {
            return response()->json([
                "status" => "err",
                "message" => "The file that you want to delete does not exist."
            ]);
        }

        return response()->json([
            "status" => "ok",
            "message" => "Selected todo deleted succesfully."
        ]);
    }
}
