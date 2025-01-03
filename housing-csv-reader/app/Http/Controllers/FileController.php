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
        error_log("/submit controller route");

        if ($request->hasFile("csv_file")) {
            error_log("File uploaded!");
        } else {
            error_log("no file :(");
        }

        return response('hello');
    }
}
