<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    //
    public function index()
    {
        // dd(auth()->user()->id);
        $posts = Post::where('user_id', auth()->user()->id)->get();
        // dd($posts);
        return view(
            'admin.posts.index',
            ['posts' => $posts]
        );
    }
}
