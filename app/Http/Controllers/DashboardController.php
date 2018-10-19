<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //$posts = Post::paginate(5);

        //Author::paginate(5);
        //$posts = Post:: orderBy('created_at', 'desc')->paginate(3);
        //return view('posts.index')->with('posts',$posts);

        // $authors = Author::paginate(5);
        // return view('authors.index', compact('authors'));

        return view('dashboard')->with('posts', $user->posts);
    }
}
