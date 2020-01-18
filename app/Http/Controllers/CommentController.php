<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Comment;
use DB;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        ['body' => 'required',]);

        $comment=new Comment;
        $comment->body = $request->input('body');
        $comment->user_id = auth()->user()->id;
        $comment->p_id =  $request->input('p_id');
        $comment->save();

        return redirect('/posts')->with('success','comment created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment=Comment::find($id);
        return view('comments.show')->with('comment',$comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment=Comment::find($id);
        if(Auth()->user()->id == $post->user_id || Auth()->user()->auth =='admin')
        {
            return view('comments.edit')->with('comment',$comment);
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
        ['body' => 'required']);


        $comment= Comment::find($id);
        $comment->body = $request->input('body');
        $comment->save();

        return redirect('/posts')->with('success','comment Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment= Comment::find($id);
        if(Auth()->user()->id !== $comment->user_id)
        {
            return redirect('/posts')->with('error','unauthorized page');
        }

        $comment->delete();
        return redirect('/posts')->with('success','comment Removed');
    }
    
}
