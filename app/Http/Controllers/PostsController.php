<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Storage;
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
            'body' => 'required', 
            'cover_image' => 'image|nullable|max:1999'

        ]);

        // File upload handling 
        /**
         * Delete the old image if the image was updated.
         * also the noimage.jpg file won't get deleted in case the user creates a post without an image
         * and then decides to edit it by adding one.
         * 
         */
        if($request->hasFile('cover_image')){ 

            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 
        else {
            $fileNameToStore = 'noimage.jpg';
        }
        
        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
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
            'body' => 'required', 
            'cover_image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:1999'
        ]);

        // File upload handling 
        /**
         * Delete the old image if the image was updated.
         * also the noimage.jpg file won't get deleted in case the user creates a post without an image
         * and then decides to edit it by adding one.
         * 
         */
        if($request->hasFile('cover_image')){ 

            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            
        } 
        
        // Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
                if ($post->cover_image != 'noimage.jpg') {
                    Storage::delete('public/cover_images/'.$post->cover_image);
                }
                $post->cover_image = $fileNameToStore;
        }
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

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
