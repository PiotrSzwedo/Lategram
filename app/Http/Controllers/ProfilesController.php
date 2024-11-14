<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function index($name = null){
        if ($name != null){
            return view("home");
        }
    }

    public function show($name = null)
    {
        if ($name != null && is_numeric($name)) {
            $user = User::with('profile', 'posts')->find($name);

            if ($user) {
                $postsHtml = '';

                if ($user->posts){
                    foreach ($user->posts as $post) {
                        $postsHtml .= view('post', ['post' => $post, 'user' => $user])->render();
                    }
                }

                $isCurrentLoginUserProfile = (bool) (auth()->user()->id == $name);

                return view("home", [
                    "user" => $user,
                    "posts" => $postsHtml,
                    "isCurrentLoginUserProfile" => $isCurrentLoginUserProfile
                ]);
            } else {
                return response()->json(["message" => "User not found"], 404);
            }
        }

        return response()->json(["message" => "Invalid user ID"], 400);
    }
}
