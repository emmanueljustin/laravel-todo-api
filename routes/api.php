<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Notes Api Routes
// ? Normal POST Api route 
Route::post("/notes/save", [NoteController::class, 'save']);
// ? GET Api route with specific id in the suffix
Route::get("/items/{id}", [NoteController::class, 'single']);
// ? Normal GET API route
Route::get("/notes", [NoteController::class, 'view']);

// TODO Api Routes
// // ? Create new Todo and save it to database
// Route::post("/todo/save", [TodoController::class, "saveTodo"]);
// // ? Get all Todos that are exisiting in the database
// Route::get("/todo/get_all", [TodoController::class, "getTodos"]);
// // ? Update existing Todo content and values
// Route::post("/todo/update_data", [TodoController::class, "updateTodos"]);

// ? API route for basic CRUD operations
Route::apiResource('/todos', TodoController::class);
// ? Delete existing Todos
Route::post("/todos/delete_data", [TodoController::class, "deleteTodos"]);