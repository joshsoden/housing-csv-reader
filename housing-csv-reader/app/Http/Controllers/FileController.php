<?php

namespace App\Http\Controllers;

use app\Helpers\PersonObjectConstructor;
use App\Models\Homeowner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function submit(Request $request)
    {
        error_log("FileController -> submit() called");

        $person_array = array();

        if ($request->hasFile("csv_file")) {
            error_log("File detected");
            $person_array = $this->process_request_file($request);
        } else {
            error_log("no file :(");
        }

        return response()->json($person_array);
    }

    public function store(Request $request)
    {
        $homeowners = $request->input('homeowners');
        DB::table('Homeowners')->insert($homeowners);
        return response("Hello", 200);
    }

    private function process_request_file(Request $request)
    {
        error_log("FileController -> process_request_file() called");
        $csv_contents = $this->retrieve_contents_from_request($request, "csv_file");
        $csv_lines = $this->split_content_lines($csv_contents);
        return $this->process_csv_lines($csv_lines);
    }

    private function retrieve_contents_from_request(Request $request, String $input_key)
    {
        error_log("FileController -> retrieve_contents_from_request() called");
        return file_get_contents($request->file("csv_file"));
    }

    private function split_content_lines(String $contents)
    {
        error_log("FileController -> split_content_lines() called");
        return explode("\n", $contents);
    }

    private function process_csv_lines($csv_lines)
    {
        $constructor = new PersonObjectConstructor();
        error_log("FileController -> process_csv_lines() called");
        $people = array();
        foreach($csv_lines as $line) {
            error_log("Calling constructor line parser");
            $person_objects = $constructor->create_person_object($line);
            error_log("Called constructor line parser!");
            if ($person_objects) {
                array_push($people, $person_objects);
            }
        }
        return $people;
    }
}
