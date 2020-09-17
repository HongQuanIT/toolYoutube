<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class YoutubeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('youtube.index');
    }
}