<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        return $this->show(auth()->user()->id);
    }

    public function showWithOffset($name, $offset)
    {
        if ($name != null && is_numeric($name)) {
            $user = User::find($name);

            if ($user) {

                $isFollowed = (bool) Follow::where('profile_id', $user->profile->id)->where('user_id', auth()->id())->exists();

                if (auth()->user()) {
                    $isCurrentLoginUserProfile = (bool) (auth()->user()->id == $name);
                } else {
                    $isCurrentLoginUserProfile = false;
                }


                if ($offset && $offset > 0) {
                    $posts = Post::where('user_id', $name)
                        ->orderBy('id', 'asc')
                        ->limit($offset)
                        ->get();
                }else{
                    $posts = null;
                }

                return view("home", [
                    "user" => $user,
                    "posts" => $posts,
                    "isCurrentLoginUserProfile" => $isCurrentLoginUserProfile,
                    "isFollowed" => $isFollowed,
                    "offset" => $offset
                ]);
            } else {
                abort(404);
            }
        }

        abort(404);
    }

    public function show($name)
    {
        return $this->showWithOffset($name, 0);
    }

    public function editProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = User::find(auth()->user()->id);

        return view("profile/edit", ["user" => $user]);
    }

    public function update(User $user)
    {
        if ($user->id != auth()->user()->id)
            abort(403);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'nullable|string',
            'webpage' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:10240',
        ]);

        if (request()->hasFile('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $imageArray = ['image' => $imagePath];
        } else {
            $imageArray = [];
        }

        if (!auth()->user()->profile) {
            auth()->user()->profile()->create($data);
        } else {
            auth()->user()->profile->update(array_merge(
                $data,
                $imageArray ?? []
            ));
        }

        dd(count($user->profile->like));

        return redirect("/profile/{$user->id}");
    }

    public function search()
    {
        $data = request()->validate([
            'data' => 'required|string',
        ]);

        $user = User::search($data["data"]);

        return json_encode($user);
    }

    public function searchUser()
    {
        return view("profile/search");
    }
}
