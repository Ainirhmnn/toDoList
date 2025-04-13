<?php

use App\Models\Todolist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoListController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $post = Todolist::all();
    // $post = Todolist::where('user_id', auth()->id())->get();
    $post = [];
    if(auth()->check()){
        $post = auth()->user()->usersCoolPosts()->latest()->get();
    }
    return view('home', ['posts' => $post ]);
});

Route::post('/saveList', [ToDoListController::class, 'saveList']);
Route::post('/logout', [ToDoListController::class, 'logout']);
Route::post('/login', [ToDoListController::class, 'login']);
Route::post('/create-post', [ToDoListController::class, 'createPost']);
Route::get('/edit-post/{post}', [ToDoListController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [ToDoListController::class, 'updatePost']); //update
Route::delete('/delete-post/{post}', [ToDoListController::class, 'deletePost']); //delete