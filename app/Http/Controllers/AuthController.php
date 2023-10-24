<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
    {
        $request->validated();

        $credentials = $request->only(['email', 'password']);
        $rememberUser = $request->filled('remember_me');

        if (Auth::attempt($credentials, $rememberUser)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('jobs.index')->with('success', 'You have successfully logged out.');
    }
}
