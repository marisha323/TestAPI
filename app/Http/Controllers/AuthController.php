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


        return $this->authContract->loginUser($input,$credetials);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
