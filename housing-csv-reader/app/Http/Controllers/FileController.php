<?php

namespace App\Http\Controllers;

use app\Helpers\PersonObjectConstructor;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function submit(Request $request)
    {
        error_log("/submit controller route");

        $person_array = array();

        if ($request->hasFile("csv_file")) {
            error_log("File uploaded; reading file");
            $person_array = $this->process_request_file($request);
        } else {
            error_log("no file :(");
        }

        return response()->json($person_array);
    }

    private function process_request_file(Request $request)
    {
        $csv_contents = $this->retrieve_contents_from_request($request, "csv_file");
        $csv_lines = $this->split_content_lines($csv_contents);
        return $this->process_csv_lines($csv_lines);
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
            $person_objects = $parser->create_person_object($line);
            if ($person_objects) {
                array_push($people, $person_objects);
            }
        }
        return $people;
    }
}
