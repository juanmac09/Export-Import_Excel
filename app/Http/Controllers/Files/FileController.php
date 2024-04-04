<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Interfaces\IFiles;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public $fileServices;

    public function __construct(IFiles $fileServices)
    {
        $this -> fileServices = $fileServices;
    }

    public function uploadFile(UploadFileRequest $request){
        $file = $request -> file('data');
       $this -> fileServices -> uploadFile($file);
    }


}
