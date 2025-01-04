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
            $this->process_request_file($request);
        } else {
            error_log("no file :(");
        }

        return response('hello');
    }

    private function process_request_file(Request $request)
    {
        $csv_contents = $this->retrieve_contents_from_request($request, "csv_file");
        $csv_lines = $this->split_content_lines($csv_contents);
    }

    private function retrieve_contents_from_request(Request $request, String $input_key)
    {
        return file_get_contents($request->file("csv_file"));
    }

    private function split_content_lines(String $contents)
    {
        return explode("\n", $contents);
    }


}
