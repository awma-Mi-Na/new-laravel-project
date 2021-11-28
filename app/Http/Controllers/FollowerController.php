<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FollowerController extends Controller
{
    //
    public function store()
    {
        $attributes = request()->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'follower_id' => ['required', Rule::exists('users', 'id')->where('id', auth()->user()->id)]
        ]);

        dd($attributes, request()->all());

        // Follower::create($attributes);

        return back()->with('success', 'Author has been followed');
    }
}
