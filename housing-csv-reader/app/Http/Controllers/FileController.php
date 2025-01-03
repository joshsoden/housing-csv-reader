<?php

namespace App\Http\Controllers;

use app\Helpers\CsvParser;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // CSV parser
    public CsvParser $parser;
    
    public function submit(Request $request)
    {
        error_log("/submit controller route");

        if ($request->hasFile("csv_file")) {
            error_log("File uploaded; reading file");
            $csv = $request->file("csv_file");

            // TODO: Call parser with get_contents method
            // $reader = new CsvParser($csv->getRealPath());
            // $reader->read_file();
        } else {
            error_log("no file :(");
        }

        return response('hello');
    }
}
