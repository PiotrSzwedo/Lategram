<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index(){
        return $this->show(auth()->user()->id);
    }

    public function show($name = null)
    {
        if ($name != null && is_numeric($name)) {
            $user = User::find($name);

            if ($user) {
                $postsHtml = '';

                if ($user->posts){
                    foreach ($user->posts as $post) {
                        $postsHtml .= view('post', ['post' => $post, 'user' => $user])->render();
                    }
                }

                if (auth()->user()){
                    $isCurrentLoginUserProfile = (bool) (auth()->user()->id == $name);
                }else {
                    $isCurrentLoginUserProfile = false;
                }

                return view("home", [
                    "user" => $user,
                    "posts" => $postsHtml,
                    "isCurrentLoginUserProfile" => $isCurrentLoginUserProfile
                ]);
            } else {
                abort(404);
            }
        }

        abort(404);
    }

    public function editProfile(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = User::find(auth()->user()->id);

        return view("profile/edit", ["user" => $user]);
    }

    public function update(User $user){
        if ($user->id != auth()->user()->id) abort(403);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'webpage' => 'url',
            'image' => '',
        ]);

        $imagePath = request('image')->store('profile', 'public');
        $imageArray = ['image' => $imagePath];

        if (!auth()->user()->profile) {
            auth()->user()->profile()->create($data);
        } else {
            auth()->user()->profile->update(array_merge(
                $data,
                $imageArray ?? []
            ));
        }

        return redirect("/profile/{$user->id}");
    }

    public function search(){
        $data = request()->validate([
            'data' => 'required|string',
        ]);

        $user = User::search($data["data"]);

        return json_encode( $user);
    }

    public function searchUser(){
        return view("profile/search");
    }
}
