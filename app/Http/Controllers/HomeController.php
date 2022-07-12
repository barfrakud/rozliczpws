<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function krajowa()
    {
        return view('national');
    }

    public function zagraniczna()
    {
        return view('foreign');
    }

    public function pomoc()
    {
        return view('help');
    }

    public function kontakt()
    {
        return view('contact');
    }

    public function podstawa()
    {
        return view('legal');
    }
}
