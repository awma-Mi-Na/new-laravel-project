<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //
    public function index()
    {
        // $this->authorize('admin');
        $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(5)->withQueryString();

        // if (request('search')) {
        //     $posts
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        return view('posts.index', [
            'posts' => $posts //->with('category', 'author')->get() //!also possible to use array as parameter in with()
        ]);
    }

    public function show(Post $post)
    {

        //? what to do? => find a post by its id and display it on the view 'post'

        return view('posts.show', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    //? this is done without query scopes
    // public function getPosts()
    // {
    //     $posts = Post::latest();

    //     if (request('search')) {
    //         $posts
    //             ->where('title', 'like', '%' . request('search') . '%')
    //             ->orWhere('body', 'like', '%' . request('search') . '%');
    //     }
    //     return $posts->get();
    // }

}
