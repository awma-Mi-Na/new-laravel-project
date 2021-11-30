<?php

namespace App\Jobs;

use App\Mail\NewPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class CreateNewPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $attributes = array('title' => '', 'slug' => '', 'excerpt' => '', 'thumbnail' => '', 'body' => '', 'category_id', 'save_draft' => '0');

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $tries = 5;
    public $maxException = 3;
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post = Post::create($this->attributes);

        //? sending mail to all followers of post's author
        $followers = User::find(auth()->user()->id)->followers;
        foreach ($followers as $follower) {
            Mail::to($follower->follower->email)->send(new NewPost($post));
        }

        // info('this is from create new post');
    }
}

// ? job can be configured with many parameters (they are declared public)
// ? timeout, tries, backoff
// ? functions: retryUntil()