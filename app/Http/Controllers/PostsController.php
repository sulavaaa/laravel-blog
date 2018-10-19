<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
//use DB;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Post::all();
        //$posts = Post::all();
        //$posts = Post:: where('title','Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');

        // To limit our posts 
        //$posts = Post:: orderBy('created_at', 'desc')->take(1)->get();
        //$posts = Post:: orderBy('created_at', 'desc')->take(5)->get();
        
        //$posts = Post:: orderBy('created_at', 'desc')->get();

        // With Pagination -> add {{$posts->links()}} in your index.blade.php too

        $posts = Post:: orderBy('created_at', 'desc')->paginate(3);
        
        return view('posts.index')->with('posts',$posts);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'  
        ]);
        
        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id= auth()->user()->id;
        $post->save();

        //return redirect('/posts')->with('success', 'Post Created');
        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Post::find($id);
        //return view();

        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        // Check for correct user.
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'  
        ]);
        
        // Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        //return redirect('/posts')->with('success', 'Post Created');
        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'Post Updated!');
        
        //return redirect()->route('posts.show', ['post' => $id])->with('success', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        // Implement toastr 
        // $notification = array(
        //     'message' => 'Post deleted Successfully!', 
        //     'alert-type' => 'success'
        // );
        
        //return Redirect::to('/posts')->with($notification);
        //return Route::redirect('/posts')->with('success','Post Removed');

        // Check for correct user.
        if(auth()->user()->id != $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
