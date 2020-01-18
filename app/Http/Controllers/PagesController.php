<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title='Welcom to laravel';
        return view('pages.index')->with('title',$title);
    }

    public function about()
    {
        $title='about us';
        return view('pages.about')->with('title',$title);
    }

    public function services()
    {
        $title='Services';
        return view('pages.services')->with('title',$title);
    }

    public function contact()
    {
        $title='contact';
        return view('pages.contact')->with('title',$title);
    }

}
