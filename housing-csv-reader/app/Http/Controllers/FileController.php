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
            error_log("File uploaded; reading file");
            $csv = $request->file("csv_file");
            $csv_data = file_get_contents($csv->getRealPath());
            error_log(json_encode($csv_data));
        } else {
            error_log("no file :(");
        }

        return response('hello');
    }
}
