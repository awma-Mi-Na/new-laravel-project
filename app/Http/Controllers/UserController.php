<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserController extends Controller
{
    public function edit(User $user)
    {
        // dd(auth()->user()->username, $user->username);
        if (auth()->user()->username === $user->username) {
            return view('user.edit', ['user' => $user]);
        }
        // abort(Response::HTTP_BAD_REQUEST);
        // throw new BadRequestHttpException();
        abort(403);
        // return redirect('/');
    }

    public function update(User $user)
    {
        // $user_before = $user;
        $attributes = $this->validateUser($user);
        if (isset($attributes['avatar'])) {
            # code...
            $attributes['avatar'] = request()->file('avatar')->store('/', ['disk' => 'avatar_path']);
        }
        $user->update($attributes);
        // dd($user_before, $user);

        return back()->with('success', 'Account details have been updated!');
    }

    public function validateUser(?User $user = null): array
    {
        $user = $user ?? new User();
        $attributes = request()->validate([
            'email' => ['email', Rule::unique('users', 'email')->ignore($user)],
            'username' => ['required', Rule::unique('users', 'username')->ignore($user)],
            'name' => 'required',
            'avatar' => 'nullable'
        ]);
        return $attributes;
    }
}
