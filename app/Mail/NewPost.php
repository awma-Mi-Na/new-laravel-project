<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPost extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $afterCommit = true;
    protected $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.new', [
            'author' => $this->post->author->name,
            'title' => $this->post->title,
            'thumbnail' => $this->post->thumbnail,
            'url' => 'http://laravel.test/posts/' . $this->post->slug
        ]);
    }
}
