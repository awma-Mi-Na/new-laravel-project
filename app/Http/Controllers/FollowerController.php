<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FollowerController extends Controller
{
    public function show(User $user)
    {
        $followers = $user->followers;
        return view('follow.follower', ['followers' => $followers]);
    }
    public function store()
    {
        $attributes = request()->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'follower_id' => ['required', Rule::exists('users', 'id')->where('id', auth()->user()->id)]
        ]);

        // dd($attributes, request()->all());

        Follower::create($attributes);

        return back()->with('success', 'Author has been followed');
    }

    public function destroy(Follower $follower)
    {
        // $follower->following->delete();
        $follower->delete();
        return back()->with('success', 'Unfollowed author.');
    }
}
