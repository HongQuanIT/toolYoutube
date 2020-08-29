<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
    public function icons()
    {
        return view('pages.icons');
    }
    public function tableList()
    {
        return view('pages.table_list');
    }
    public function typography()
    {
        return view('pages.typography');
    }
    public function map()
    {
        return view('pages.map');
    }
    public function notifications()
    {
        return view('pages.notifications');
    }
    public function language()
    {
        return view('pages.language');
    }
    public function upgrade()
    {
        return view('pages.upgrade');
    }
}
