<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        //Passing Value into blade template
        $title = 'Hello Laravel!';
        //return view('pages.index');
        // 2 ways to do it. 
        // Second way : this way we can pass multiple values and thus is recommended way
        return view('pages.index')->with('title',$title);

    }

    public function about(){
        $title = 'Hello About page!!';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $title = 'Hello Services!';
        return view('pages.services')->with('title',$title);
    }

}
