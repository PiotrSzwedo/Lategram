<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function storage(){

        $data = request()->validate([
            "post_id" => "required",
        ]);

        $post = Post::find($data["post_id"]);

        if (!Like::where('post_id', $post->id)
                    ->where('user_id', auth()->id())
                    ->exists()
            ){
            auth()->user()->liked()->create([
                "post_id" => $post->id,
                "user_id" => auth()->id()
            ]);
        }

        return abort(200);
    }

    public function unLike(){
        $data = request()->validate([
            "post_id" => "required",
        ]);

        $post = Post::find($data["post_id"]);

        $like = Like::where('post_id', $post->id)->where('user_id', auth()->id());
        
        if ($like->exists()){
            $like->delete();

            return abort(200);
        }

        abort(404);
    }
}
