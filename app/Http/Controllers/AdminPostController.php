<?php

namespace App\Http\Controllers;

use App\Jobs\CreateNewPost;
use App\Jobs\UpdatePost;
use App\Mail\NewPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Mail;

class AdminPostController extends Controller
{
    // public function create()
    // {
    //     return view('admin.posts.create');
    // }

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

    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(40)
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        // UpdatePost::dispatch($attributes, $post);
        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        // dd(($post->in_draft) === '0');
        //? if the post is published then send email to all the followers of the author of that post
        if ($post->in_draft === '0') {
            $followers = User::find($post->author->id)->followers;
            foreach ($followers as $follower) {
                Mail::to($follower->follower->email)->send(new NewPost($post));
            }
        }

        return back()->with('success', 'Post updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        File::delete(storage_path('/app/public/thumbnails/' . $post->thumbnail));

        return back()->with('success', 'Post Deleted');
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
