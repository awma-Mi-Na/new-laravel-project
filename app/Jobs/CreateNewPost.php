<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNewPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $attributes = array('title' => '', 'slug' => '', 'excerpt' => '', 'thumbnail' => '', 'body' => '', 'category_id');

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
        Post::create($this->attributes);
        // info('this is from create new post');
    }
}

// ? job can be configured with many parameters (they are declared public)
// ? timeout, tries, backoff
// ? functions: retryUntil()