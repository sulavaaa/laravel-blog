<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        //Passing Value into blade template
        $title = 'Hello Laravel';
        //return view('pages.index');
        // 2 ways to do it. 
        // First way
        return view('pages.index',compact('title'));

    }

    public function about(){
        return view('pages.about');
    }

    public function services(){
        return view('pages.services');
    }

}
