<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // return request()->all();
        $attributes = request()->validate([
            'name' => 'required|max:255|min:2',
            'username' => 'required|min:5|max:255|unique:users,username',
            // 'username' => ['required','min:5','max:255', Rule::unique('users','username')],            
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:5'],
        ]);

        //! if validation fails laravel redirects to the prev page, i.e. the registration page in this case, and does not proceed to the next line of code

        // encrypt the password 
        // $attributes['password'] = bcrypt($attributes['password']);
        //? encryption here is not required now since a mutator has been defined in User::class

        //? create the user in the db
        $user = User::create($attributes);

        auth()->login($user);

        session()->flash('success', 'Your account has been created.');

        return redirect('/');

        // flash message can also be displayed as below
        // return redirect('/')->with('success','Your account has been created.');
    }
}
