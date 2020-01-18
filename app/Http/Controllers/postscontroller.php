<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

use App\post;
use App\Comment;
use App\User;
use App\Tag;
use DB;
class postscontroller extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' =>['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=post::all();
        $comments=Comment::all();
        //$posts=post::orderBy('title','desc')->paginate(1);
        $q = post::query();
       
            
       
           return view('posts.index', compact('posts', 'comments'));
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
        $this->validate($request,
        ['title' => 'required',
        'body' => 'required',
        'tags' => 'required',
        'cover_image' => 'image|nullable|max:1999']);

        if($request->hasFile('cover_image'))
        {
             //get file name with excetntion
             $fileNamewithExt = $request->file('cover_image')->getClientOriginalName();
             //get just image name
             $fileName=pathinfo($fileNamewithExt,PATHINFO_FILENAME);
             //get just ext
             $EXT= $request->file('cover_image')->getClientOriginalExtension();
             //fileName to stor
             $filetoNameToStor = $fileName.'_'.time().'.'.$EXT;
             //Uplode image
             $path=$request->file('cover_image')->storeAs('storage\cover_images',$filetoNameToStor);

        }else{
           $filetoNameToStor='No-image.png';
        }


        $post=new post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->tags =  $request->input('tags');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $filetoNameToStor;
        $post->save();

       
        return redirect('/posts')->with('success','post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=post::find($id);
        if(Auth()->user()->id == $post->user_id || Auth()->user()->auth =='admin')
        {
            return view('posts.edit')->with('post',$post);
        }
        else{
            return redirect('/posts')->with('error','unauthorized page');
        }
      
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

        $this->validate($request,
        ['title' => 'required',
        'body' => 'required',
        'cover_image' => 'image|nullable|max:1999']);

        if($request->hasFile('cover_image'))
        {
             //get file name with excetntion
             $fileNamewithExt = $request->file('cover_image')->getClientOriginalName();
             //get just image name
             $fileName=pathinfo($fileNamewithExt,PATHINFO_FILENAME);
             //get just ext
             $EXT= $request->file('cover_image')->getClientOriginalExtension();
             //fileName to stor
             $filetoNameToStor = $fileName.'_'.time().'.'.$EXT;
             //Uplode image
             $path=$request->file('cover_image')->storeAs('public\cover_images',$filetoNameToStor);
        }


        $post= post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $filetoNameToStor;
        }
        $post->save();

        return redirect('/posts')->with('success','post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= post::find($id);
        if(Auth()->user()->id == $post->user_id || Auth()->user()->auth =='admin')
        {
            if($post->cover_image !='No-image.png')
            {
               //delete
               Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $post->delete();
            return redirect('/home')->with('success','post Removed');
        }else{
            return redirect('/posts')->with('error','unauthorized page');
        }

      
    }


    public function search(Request $request)
    {
        $user_id = auth()->user()->id;
        $comments=Comment::all();
        $user = User::all();
        $search=$request->input('search');
        $allpost=post::all();
        $posts=post::where('title','Like','%'.$search.'%')->orwhere('tags','Like','%'.$search.'%')->get();
        return view('posts.search')->with('posts',$posts)->with('comments',$comments)->with('allpost',$allpost);
    }

    public function searchcat(Request $request,$cats)
    {
        $user_id = auth()->user()->id;
        $comments=Comment::all();
        $user = User::all();
        $allpost=post::all();
       // $search=$request->input('searchcat');
        $posts=post::where('title','Like','%'.$cats.'%')->orwhere('tags','Like','%'.$cats.'%')->get();
        return view('posts.cat')->with('posts',$posts)->with('comments',$comments)->with('allpost',$allpost);
    }
}
