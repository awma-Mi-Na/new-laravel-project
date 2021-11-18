<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // User::truncate();
        // Category::truncate();
        // Post::truncate();

        // $users = User::factory(2)->create();
        // // $user2 = User::factory()->create();
        // // foreach ($users as $user) {
        // //     $user->id;
        // // }
        // $family = Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);
        // $personal = Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);
        // $work = Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);
        // Post::create([
        //     'category_id' => $family->id,
        //     'author_id' => $users[0]->id,
        //     'title' => 'My Family Post',
        //     'slug' => 'my-family-post',
        //     'excerpt' => 'This is a family post',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quidem voluptatem cum corporis quos sint placeat tempora, fuga in eum. Numquam similique quasi tenetur voluptate quisquam voluptatibus aperiam mollitia placeat.'
        // ]);
        // Post::create([
        //     'category_id' => $personal->id,
        //     'author_id' => $users[1]->id,
        //     'title' => 'My personal Post',
        //     'slug' => 'my-personal-post',
        //     'excerpt' => 'This is a personal post',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quidem voluptatem cum corporis quos sint placeat tempora, fuga in eum. Numquam similique quasi tenetur voluptate quisquam voluptatibus aperiam mollitia placeat.'
        // ]);
        // Post::create([
        // 'category_id' => $work->id,
        // 'author_id' => $users[0]->id,
        // 'title' => 'My Work Post',
        // 'slug' => 'my-work-post',
        // 'excerpt' => 'This is a work post',
        // 'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum quidem voluptatem cum corporis quos sint placeat tempora, fuga in eum. Numquam similique quasi tenetur voluptate quisquam voluptatibus aperiam mollitia placeat.'
        // ]);

        User::factory()->create([
            'email' => 'awma@gmail.com',
            'username' => 'awma123',
            'password' => 'password'
        ]);

        $users = User::factory(3)->create();


        $categories = Category::factory(5)->create();

        Post::factory(2)->create(
            [
                'user_id' => $users[0]->id,
                'category_id' => $categories[0]->id
            ]
        );
        Post::factory(1)->create(
            [
                'user_id' => $users[1]->id,
                'category_id' => $categories[1]->id
            ]
        );
        Post::factory(3)->create(
            [
                'user_id' => $users[2]->id,
                'category_id' => $categories[2]->id
            ]
        );
        Post::factory(2)->create(
            [
                'user_id' => $users[0]->id,
                'category_id' => $categories[3]->id
            ]
        );
        Post::factory(4)->create(
            [
                'user_id' => $users[2]->id,
                'category_id' => $categories[4]->id
            ]
        );
    }
}
