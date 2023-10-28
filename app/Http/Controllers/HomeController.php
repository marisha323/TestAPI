<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        return view('home');
    }
    public function adminHome(){
        $links=Link::all();
        return view('adminHome', ['links' => $links]);

    }
    public function managerHome(){
        $links=Link::all();
        return view('managerHome', ['links' => $links]);

    }

}
