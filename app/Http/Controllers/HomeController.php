<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\post;
class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $users = User::all();
        return view('home')->with('posts',$user->posts)->with('users',$users);
    }

    public function store(Request $request)
    {
        $this->validate($request,
        ['name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'auth' => 'required',
        'profile_image' => 'image|nullable|max:1999']);

        if($request->hasFile('profile_image'))
        {
             //get file name with excetntion
             $fileNamewithExt = $request->file('profile_image')->getClientOriginalName();
             //get just image name
             $fileName=pathinfo($fileNamewithExt,PATHINFO_FILENAME);
             //get just ext
             $EXT= $request->file('profile_image')->getClientOriginalExtension();
             //fileName to stor
             $filetoNameToStor = $fileName.'_'.time().'.'.$EXT;
             //Uplode image
             $path=$request->file('profile_image')->storeAs('public\profile_images',$filetoNameToStor);

        }else{
           $filetoNameToStor='No-image.png';
        }


        $user=new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password =  Hash::make($request['password']);
        $user->auth =  $request->input('auth');
        $user->profile_image = $filetoNameToStor;
        $user->save();

        return redirect('/dashbord')->with('success','user created');
    }

    public function show($id)
    {
        $user=User::find($id);
        if(Auth()->user()->id == $id|| Auth()->user()->auth =='admin')
      {  return view('users.edit')->with('user',$user);
    }
    else{
        return redirect()->back()->with('error','unauthorized page');
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        if(Auth()->user()->id == $id|| Auth()->user()->auth =='admin')
        {
            return view('users.edit')->with('user',$user);
        }
        else{
            return redirect('/posts')->with('error','unauthorized page');
        }
    }
    public function update(Request $request, $id)
    {

        $this->validate($request,
        ['name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'auth' => 'required',
        'profile_image' => 'image|nullable|max:1999']);

        if($request->hasFile('profile_image'))
        {
             //get file name with excetntion
             $fileNamewithExt = $request->file('profile_image')->getClientOriginalName();
             //get just image name
             $fileName=pathinfo($fileNamewithExt,PATHINFO_FILENAME);
             //get just ext
             $EXT= $request->file('profile_image')->getClientOriginalExtension();
             //fileName to stor
             $filetoNameToStor = $fileName.'_'.time().'.'.$EXT;
             //Uplode image
             $path=$request->file('profile_image')->storeAs('public\storge\profile_image',$filetoNameToStor);

        }else{
           $filetoNameToStor='No-image.png';
        }


        $user= User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($request->hasFile('profile_image'))
        {
            $post->profile_image = $filetoNameToStor;
        }
        $user->save();

        return redirect('/home')->with('success','post Updated');
    }
}
