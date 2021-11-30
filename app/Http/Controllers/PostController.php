<?php

namespace App\Http\Controllers;

use App\Jobs\CreateNewPost;
use App\Jobs\UpdatePost;
use App\Mail\NewPost;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Mail;

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
        // $client = request()->ip();
        // request()->session()->put('ip', $client);

        // $server = request()->server('SERVER_ADDR');
        // request()->session()->put('ip_server', $server);

        // dd(request()->session()->all());

        return view('posts.index', [
            'posts' => $posts //->with('category', 'author')->get() //!also possible to use array as parameter in with()
        ]);
    }

    public function show(Post $post)
    {

        //? what to do? => find a post by its id and display it on the view 'post'
        $post->no_views = ++$post->no_views;
        $post->save();
        // dd($post->no_views);

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
        // dd(request()->is('posts/' . auth()->user()->username . '/create'));
        if (auth()->user()->username === $user->username) {
            // if (auth()->user()->username === "awma123")
            //     return view('admin.posts.create');

            return view('admin.posts.create');
        }
        abort(403);
    }

    public function store()
    {
        $attributes = $this->validatePost(new Post());

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('/', ['disk' => 'thumbnails_path']);
        // dd($attributes);

        // Post::create($attributes);
        // $followers = User::find(auth()->user()->id)->followers;
        // dd()

        CreateNewPost::dispatch($attributes);


        return back()->with('success', 'Your post has been added.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        // dd($attributes);

        UpdatePost::dispatch($attributes, $post);

        return back()->with('success', 'Post updated');
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
        ]);

        return $attributes;
    }
}
