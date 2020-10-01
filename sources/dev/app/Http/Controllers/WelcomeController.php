<?php

namespace App\Http\Controllers;
use Auth;

class WelcomeController extends Controller
{
    public function welcome()
    {
        if (Auth::check())
        {
            return redirect('home');
        }
        return view('welcome');
    }
}
