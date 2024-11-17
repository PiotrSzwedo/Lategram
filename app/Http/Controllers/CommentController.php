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
            'body' => 'string',
            'post_id' => 'string',
        ]);

        $data["user_id"] = auth()->user()->id;

        auth()->user()->comment()->create($data);
    }
}
