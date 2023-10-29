<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $links=Link::all();
        return view('home', ['links' => $links]);

    }


}
