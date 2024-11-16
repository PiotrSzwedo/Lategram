<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function show(\App\Models\Post $post){
        return view("post/show", ['post' => $post]);
    }

    public function create(){
        return view("post/create");
    }

    public function storage(){
        $data = request()->validate([
            'another' => '',
            'body' => 'nullable|string',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'title' => $data['title'],
            'image' => $imagePath,
            'body' => $data['body'] ?? null
        ]);

        redirect("/profile" . auth()->user()->id);
    }
}
