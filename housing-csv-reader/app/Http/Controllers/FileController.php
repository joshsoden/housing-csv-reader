<?php

namespace App\Http\Controllers;

use app\Helpers\CsvParser;
use app\Helpers\PersonObjectConstructor;
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
        $person_array = $this->process_csv_lines($csv_lines);
    }

    private function retrieve_contents_from_request(Request $request, String $input_key)
    {
        return file_get_contents($request->file("csv_file"));
    }

    private function split_content_lines(String $contents)
    {
        return explode("\n", $contents);
    }

    private function process_csv_lines($csv_lines)
    {
        $parser = new PersonObjectConstructor();
        $people = array();
        foreach($csv_lines as $line) {
            error_log("Parsing line...");
            $person_objects = $parser->create_person_object($line);
            if ($person_objects) {
                array_push($people, $person_objects);
            }
        }
        error_log(json_encode($people));
        return $people;
    }
}
