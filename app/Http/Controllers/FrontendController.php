<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view();
    }
    public function about_us(){
        return view('about');
    }
}
