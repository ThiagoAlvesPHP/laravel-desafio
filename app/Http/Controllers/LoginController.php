<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $array;

    public function __construct()
    {
        $this->array = [];
    }

    public function authenticate(Request $request)
    {
        $creds = $request->only(['email', 'password']);

        if (Auth::attempt($creds)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with(
                "status", "Invalid email and/or password!"
            );
        }
    }
}
