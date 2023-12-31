<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function uploadImage(Request $request){
        try{
            if($request->exists("upload")){
                $file = $request->file("upload");
                $file_id = File::uploadFileAWS($file,$request->get("folder"));
                $file = File::getFileFromAWS(File::find($file_id)->url);
                return response()->json($file,200) ;
            }
            return response()->json("",200) ;
        }
        catch (\Exception $exception) {
            return ResponseService::DefineException($exception);
        }

    }



}
