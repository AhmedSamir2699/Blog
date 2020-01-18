<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AdminLogController extends Controller
{
    public function __constrcut()
    {
       $this->middleware('guest::admin')->except('logout');
    }
    public function showLoginform()
    {
        return view('auth.admin-login');
    }
    protected $redirectTo = '/posts/index';


    public function login(Request $request)
    {
        $this->validate($request,
        [
        'email' => 'required',
        'password' => 'required',
       ]);

       if( Auth::guard('admins')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
       {
         return redirect()->intended(route('posts.index'));
       }
       return redirect()->back()->withInput($request->only('email','remember'));
    }
}
