<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (auth()->attempt($credentials)) {
            // redirect with a success flash message
            //? session()->regenerate(); this is to generate random session tokens??
            return redirect('/')->with('success', 'Welcome Back!');
        }

        // if auth fails
        // return back()->withErrors(['email' => 'The provided credentials could not be verified.'])->withInput();

        // by using validation exception
        throw ValidationException::withMessages(['email' => 'The provided credentials could not be verified.']);

        //! in the tutorial, auth success is put at the end, the validation exception is thrown in the if block and consequently the condition has to be negated
    }
}
