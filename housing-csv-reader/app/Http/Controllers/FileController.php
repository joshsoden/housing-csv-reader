<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Parse .csv file  
     */
    public function submit(Request $request)
    {
        error_log(json_encode($request->file()));
        error_log("/submit controller route");

        return response('hello');
    }
}
