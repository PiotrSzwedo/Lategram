<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Profile $profile) {
        if (!Follow::where('profile_id', $profile->id)
                    ->where('user_id', auth()->id())
                    ->exists()
            ){
            auth()->user()->followed()->create([
                "profile_id" => $profile->id,
                "user_id" => auth()->id()
            ]);
        }

        return response()->json(['message' => 'Followed successfully'], 200);
    }

    public function unFollow(Profile $profile){

        $follow = Follow::where('profile_id', $profile->id)
        ->where('user_id', auth()->id())
        ->first();

        if ($follow) {
            $follow->delete();
        }

        return abort(200);
    }
}
