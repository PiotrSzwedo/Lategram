<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storage(){
        $data = request()->validate([
            'body' => 'required|string',
            'post_id' => 'required|string',
        ]);

        auth()->user()->comment()->create($data);
    }
}
