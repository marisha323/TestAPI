<?php

namespace App\Repositories;

use App\Contracts\AuthContract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthContract
{
    public function __construct()
    {

    }

    public function loginUser($input, $credetials)
    {

        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login ');
        } else {

            return redirect()->route('login')->with('error', 'Email or Password salah');
        }
    }

    public function registerUser($request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return back()->with('success', 'Register successfuly');
    }
}
