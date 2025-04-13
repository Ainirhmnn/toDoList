<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todolist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ToDoListController extends Controller
{
    public function saveList(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users','name')],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user); //login
        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'login_name' => ['required'],
            'login_password' => ['required'],
        ]);

        if(auth()->attempt(['name' => $incomingFields['login_name'], 'password' => $incomingFields['login_password']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        $incomingFields['is_completed'] = 'N';
        $incomingFields['user_id'] = auth()->id();
        Todolist::create($incomingFields);
        return redirect ('/');
    }

    public function showEditScreen(Todolist $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post',['post' => $post]);
    }

    public function updatePost(Todolist $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);
        
        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Todolist $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }
}
