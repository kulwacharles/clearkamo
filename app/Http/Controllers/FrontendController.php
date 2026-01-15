<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view();
    }
    public function about_us(){
        dd("this is found heere");
        return view('about');
    }
}
