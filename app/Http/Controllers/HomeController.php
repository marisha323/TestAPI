<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function adminHome(){
        return view('adminHome');
    }
    public function managerHome(){
        return view('managerHome');
    }

}