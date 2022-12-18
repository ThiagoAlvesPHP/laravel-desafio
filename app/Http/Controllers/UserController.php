<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * page register user
     */
    public function index()
    {
        return view('register');
    }

    /**
     * action register user
     */
    public function register(Request $request)
    {
        $users = User::all()->where("email", $request->input('email'));

        if ($users->count() === 0) {
            $rulesFormOne = [
                'name'      => 'required|min:3',
                'email'     => 'required|min:10',
                'password'     => 'required|min:8'
            ];

            $validator = Validator::make($request->all(), $rulesFormOne);

            if($validator->fails()) {
                return redirect()->route('register')->withErrors($validator)->withInput();
            }

            $req = $request->only(['name', 'email', 'password']);
            $req['password'] = Hash::make($req['password']);

            User::create($req);
            return redirect()->route('register')->with('status', 'Registration successfully completed!');
        } else {
            return redirect()->route('register')->with('status', 'Email already registered!');
        }
    }
}
