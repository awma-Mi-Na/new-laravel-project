<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    public function create()
    {
    }
    public function edit(Comment $comment)
    {
        return view('comment.edit', ['comment' => $comment]);
    }

    public function update(Comment $comment)
    {
        $attributes = request()->validate([
            'body' => 'required|min:5'
        ]);

        // dd($comment->post->slug);
        $comment->update($attributes);


        return redirect("/posts/{$comment->post->slug}")->with('success', 'Comment has been updated!');
    }
}
