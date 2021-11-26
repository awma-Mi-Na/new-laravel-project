<?php

namespace App\Console;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {

            $thumbnailsDB = Post::select('thumbnail')->distinct()->get()->toArray();
            $thumbnailsDB = array_column($thumbnailsDB, 'thumbnail');
            $thumbnails = Storage::disk('thumbnails_path')->allFiles();
            $thumbnails_toDelete = array_diff($thumbnails, $thumbnailsDB);
            Storage::disk('thumbnails_path')->delete($thumbnails_toDelete);

            $avatarsDB = User::select('avatar')->distinct()->get()->toArray();
            $avatarsDB = array_column($avatarsDB, 'avatar');
            $avatars = Storage::disk('avatar_path')->allFiles();
            $avatars_toDelete = array_diff($avatars, $avatarsDB);
            Storage::disk('avatar_path')->delete($avatars_toDelete);
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
