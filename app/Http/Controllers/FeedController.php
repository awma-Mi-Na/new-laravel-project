<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    public function __invoke()
    {
        $posts = DB::table('posts')->orderBy('updated_at', 'desc')->get();

        return view('posts.feed', ['posts' => $posts]);

        // $content = view('posts.feed', compact('posts'));

        // return response($content, 200)
        //     ->header('Content-Type', 'text/xml');
    }
}
