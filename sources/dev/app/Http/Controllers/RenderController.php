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

        $id = Auth::user()->id;
        if (!file_exists(public_path()."/backend/output/$id")) {
            mkdir(public_path()."/backend/output/$id", 0777, true);
            mkdir(public_path()."/backend/output/$id/logo", 0777, true);
            mkdir(public_path()."/backend/output/$id/background", 0777, true);
        }
        //Move Uploaded File
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $destinationPath_logo = public_path()."/backend/files/$id/logo";
            $logo->move($destinationPath_logo,$logo->getClientOriginalName());
        }
        if($request->hasFile('backgrond')){
            $background = $request->file('background');
            $destinationPath_background = public_path()."/backend/files/$id/logo";
            $background->move($destinationPath_background,$background->getClientOriginalName());
        }
        
        $frame = $request->get('frame');
        switch ($frame) {
            case 1:
                
                $files = glob(public_path()."/backend/files/$id/*.{webm,mp4}", GLOB_BRACE);
                foreach($files as $file) {
                    $path_output = public_path()."/backend/output/$id/output.avi";
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