<?php

namespace App\Http\Controllers\Api;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class YoutubeApiController extends BaseApiController
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