<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Post;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view("post/create");
    }

    public function storage()
    {
        $data = request()->validate([
            'another' => '',
            'body' => 'nullable|string',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'image' => $imagePath,
            'body' => $data['body'] ?? null
        ]);

        redirect("/profile" . auth()->user()->id);
    }

    public function show()
    {
        // Walidacja danych wejściowych
        $data = request()->validate([
            "profile_id" => "required|integer",
            "limit" => "required|integer|min:1",
            "offset" => "required|integer|min:0",
        ]);

        $posts = Post::where('user_id', $data['profile_id'])
            ->orderBy('id', 'asc')
            ->offset($data['offset'])
            ->limit($data['limit'])
            ->get();

        $hasMore = $posts->count() - Post::where('user_id', $data['profile_id'])->count() > 0;

        if ($posts) {

            return response()->json([
                'posts' => view("components.posts", ["posts" => $posts])->render(), 
                'total' => $posts->count(),
                'has_more' => $hasMore
            ]);
    }
        

        return response()->json(['message' => ''], 404);
    }
}
