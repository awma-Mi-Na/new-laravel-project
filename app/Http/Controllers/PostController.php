<?php

namespace App\Http\Controllers;

use App\Jobs\CreateNewPost;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //
    public function index()
    {
        // $this->authorize('admin');

        $posts = Post::latest()->published()->filter(request(['search', 'category', 'author']))->paginate(5)->withQueryString();

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

    public function create(User $user)
    {
        // dd($user);
        if (auth()->user()->username === $user->username) {
            if (auth()->user()->username === "awma123")
                return view('admin.posts.create');

            return view('posts.create');
        }
        abort(403);
    }

    public function store()
    {
        $attributes = $this->validatePost(new Post());
        // dd($attributes);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('/', ['disk' => 'thumbnails_path']);

        // Post::create($attributes);

        CreateNewPost::dispatch($attributes);

        return redirect('/')->with('success', 'Your post has been added.');
    }

    public function validatePost(?Post $post = null): array
    {
        $post = $post ?? new Post();
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists ? ['image'] : ['image', 'required'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'in_draft' => 'nullable',
            'user_id' => $post->exists ? ['required'] : ['nullable']
        ]);

        return $attributes;
    }
}
