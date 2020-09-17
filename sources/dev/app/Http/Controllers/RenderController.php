<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class RenderController extends Controller
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
        $id = Auth::user()->id;
        $files = glob(public_path()."/backend/files/$id/*"); // get all file names
        foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
        }
        return view('render.index');
    }

    public function render(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        $frame = $request->get('frame');
        // dd($frame);
        switch ($frame) {
            case 1:
                // dd(1);
                if (!file_exists(public_path()."/backend/output/$id")) {
                    mkdir(public_path()."/backend/output/$id", 0777, true);
                }
                $files = glob(public_path()."/backend/files/$id/*.{webm,mp4}", GLOB_BRACE);
                foreach($files as $file) {
                    // copy($file, public_path()."/backend/output/$id/".basename($file));

                    $path_output = public_path()."/backend/output/$id/output.avi";
                    // dd("ffmpeg -i $file $path_output");
                    $cmd = shell_exec("ffmpeg -i $file $path_output 2>&1");
                    if( !$cmd ){
                        dd("loi roi !");
                    }else{
                        dd('thanh cong: '.$cmd);
                    };
                }
                break;
            
            default:
                # code...
                break;
        }
    }
}