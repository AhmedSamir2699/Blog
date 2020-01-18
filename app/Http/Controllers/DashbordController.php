<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\post;

class DashbordController extends Controller
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
     
        $users = User::all();

        return view('dashbord')->with('users',$users);
    }

    public function destroy($id)
    {
        $user= User::find($id);
        if( Auth()->user()->auth !=='admin')
        {
            return redirect('/dashbord')->with('error','unauthorized page');
        }

       
        $user->delete();
        return redirect('/dashbord')->with('success','user Removed');
    }
}
