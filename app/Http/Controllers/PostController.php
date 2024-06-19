<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
   
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
    
        return view('posts.index', compact('posts'));
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'title' => 'required',
             'body' => 'required'
        ]);
   
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
   
        return back()->with('success','Post created successfully.');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function commentStore(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comment::create($input);
   
        return back()->with('success','Comment added successfully.');
    }
}