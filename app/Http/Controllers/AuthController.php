<?php

namespace App\Http\Controllers;

use App\Contracts\AuthContract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private AuthContract $authContract;
    public function __construct(AuthContract $authContract)
    {
        $this->authContract=$authContract;
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
//        $user = new User();
//
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->password = Hash::make($request->password);
//
//        $user->save();
//        return back()->with('success', 'Register successfuly');
        return $this->authContract->registerUser($request);
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $input = $request->all();
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

//        if (auth::attempt( array('email' => $input['email'], 'password' => $input['password']))) {
//            if (auth()->user()->type == 'admin') {
//                return redirect()->route('admin.home')->with('success', 'Login berhasil');;
//            } else if (auth()->user()->type == 'manager') {
//                return redirect()->route('manager.home')->with('success', 'Login berhasil');;
//            } else {
//                if (Auth::attempt($credetials)) {
//                    return redirect('/home')->with('success', 'Login berhasil');
//                }
//            }
//
//        } else {
//
//            return redirect()->route('login')->with('error', 'Email or Password salah');
//        }
        return $this->authContract->loginUser($input,$credetials);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
