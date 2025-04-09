<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function showForm() 
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    try {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'uid' => uniqid(), // Or your preferred ID generation method
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful!');
        
    } catch (\Exception $e) {
        return back()->withInput()->withErrors([
            'registration_error' => 'Registration failed: '.$e->getMessage()
        ]);
    }
}
}
