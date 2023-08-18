<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class FileDownloadController extends Controller
{
    public function getImg(File $file)
    {
        return response()->file($file->path);
    }
}
