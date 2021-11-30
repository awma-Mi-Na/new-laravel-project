<?php

namespace App\Jobs;

use App\Mail\NewPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class UpdatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $attributes = array();
    public $post;
    public function __construct(array $attributes, Post $post)
    {
        $this->attributes = $attributes;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->attributes['thumbnail'])) {
            $this->attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $this->post->update($this->attributes);
        $followers = User::find(auth()->user()->id)->followers;
        foreach ($followers as $follower) {
            Mail::to($follower->follower->email)->send(new NewPost($this->post));
        }
    }
}
