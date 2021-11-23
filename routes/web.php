<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
use App\Jobs\CreateNewPost;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PostController::class, 'index'])->name('home');


// $files = File::files(resource_path("posts/"));
// $posts = [];

// ! collection technique
// $posts = collect($files)
//     ->map(function ($file) {
//         return YamlFrontMatter::parseFile($file);
//     })
//     ->map(function ($document) {

//         return new Post(
//             $document->title,
//             $document->slug,
//             $document->excerpt,
//             $document->date,
//             $document->body()
//         );
//     });


//! array map technique
// $posts = array_map(function ($file) {
//     $document = YamlFrontMatter::parseFile($file);
//     return new Post(
//         $document->title,
//         $document->slug,
//         $document->excerpt,
//         $document->date,
//         $document->body()
//     );
// }, $files);

//! for each technique
// foreach ($files as $file) {
//     $document = YamlFrontMatter::parseFile($file);
//     $posts[] = new Post(
//         $document->title,
//         $document->slug,
//         $document->excerpt,
//         $document->date,
//         $document->body()
//     );
// }
// ddd($posts);


//! any appropriate attribute can be used to find the page you want, eg. /posts/{post:title}, we just have to change the link attribute in the corresponfing page
Route::get('/posts/{post:slug}', [PostController::class, 'show']);


// return $slug;
// $path = __DIR__ . "/../resources/posts/{$slug}.html";
// ddd($path);

// if (!file_exists($path)) {
// ddd('file does not exist'); //to debug
// abort(404); //to send a code 404a
//     return redirect('/');
// }
// $post = file_get_contents($path); //without caching

// caching

// without using arrow function
// ! remember(key, duration,function)
// note: for duration we can use now()->add[minutes,day,hour,etc.]
// $post = cache()->remember("posts.{$slug}", now()->addHour(), function () use ($path) {
//     // var_dump('file_get_contents');
//     return file_get_contents($path);
// });

// using arrow function - requires php version 7.4
// $post = cache()->remember("posts.{$slug}", now()->addHours(2), fn () ==> file_get_contents($path));




// Route::get('categories/{category:slug}', function (Category $category) {
//     return view('blog', [
//         'posts' => $category->posts,  //->load('category', 'author') not needed if $with is specified in parent model
//         'categories' => Category::all(),
//         'currentCategory' => $category
//     ]);
// })->name('category');


//! dont need this route anymore, author filter is added in the postcontroller
// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts.index', [
//         'posts' => $author->posts, //->load('category', 'author') not needed if $with is specified in parent model
//         // 'categories' => Category::all()  //not needed anymore since we now have a render for the category dropdown
//     ]);
// });

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'create']);

//? to test mailchimp api
Route::post('newsletter', NewsletterController::class);

// grouping routes with same controller, and adding the 7 restful actions on the same line
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::get('admin/posts/create', [AdminPostController::class, 'create'])->name('newpost');

    // Route::get('admin/posts', [AdminPostController::class, 'index'])->name('allposts');
    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('editpost');
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->name('updatepost');
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('deletepost');
});

// Route::get('/jobtest', function () {
//     // (new \App\Jobs\CreateNewPost)->handle();
//     CreateNewPost::dispatch()->onQueue('higherQueue');
//     //? jobs can be put on different queues, when executing the worker we can set priorities to the named queues with the --queue option
//     return ('hello');
// });

Route::get('/feed', FeedController::class);

Route::get('/user/{user:username}/edit', [UserController::class, 'edit'])->name('edituser');
Route::patch('/user/{user:username}', [UserController::class, 'update'])->name('updateuser');
