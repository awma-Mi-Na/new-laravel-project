<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', auth()->user()->id)->get();
        // dd($bookmarks->toArray());
        return view('bookmark.index', ['bookmarks' => $bookmarks]);
    }

    public function store(User $user, Post $post)
    {
        $attributes = request()->validate([
            'user_id' => 'required',
            'post_id' => 'required'
        ]);
        // dd($attributes);
        Bookmark::create($attributes);
        return back()->with('success', 'Added to bookmark');
    }

    public function destroy(Bookmark $bookmark)
    {
        Bookmark::destroy($bookmark);
        // dd($bookmark);
        // $bookmark->delete();

        return back()->with('success', 'Bookmark deleted');
    }
}
