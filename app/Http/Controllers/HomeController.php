<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $array;

    public function __construct()
    {
        $this->array = [];
    }

    public function index()
    {
        return view('home');
    }

    /**
     * action logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
