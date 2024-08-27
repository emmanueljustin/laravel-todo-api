<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthenticationController;

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

// For Authentication
Route::post("/auth/register", [AuthenticationController::class, "register"]);
Route::post("/auth/login", [AuthenticationController::class, "login"]);
/**
 * ? Encloses the TODO API routes inside auth routes so that it won't be accessible if there is no active session token
 */ 
Route::middleware('auth:sanctum')->group(function () {
    Route::post("/auth/logout", [AuthenticationController::class, "logout"]);
    Route::apiResource('/todos', TodoController::class);
    Route::post("/todos/delete_data", [TodoController::class, "deleteTodos"]);
});
