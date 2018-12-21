<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MiscController extends Controller
{
    //

    public function general_images($stuff){
    	return response()->file(public_path().'/general/image/'.$stuff.'.jpg');
    }
}
