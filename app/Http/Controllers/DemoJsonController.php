<?php

namespace App\Http\Controllers;

class DemoJsonController extends Controller
{
    public function index()
    {
        // JSON file path inside app folder
        $path = app_path('demojson.json');

        // Check if file exists
        if (!file_exists($path)) {
            return response()->json([
                'error' => 'demojson.json file not found'
            ], 404);
        }

        // Read JSON file
        $json = file_get_contents($path);

        // Convert JSON to array
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function packege_details_page()
    {
        // JSON file path inside app folder
        $path = app_path('demojson.json');

        // Check if file exists
        if (!file_exists($path)) {
            return response()->json([
                'error' => 'demojson.json file not found'
            ], 404);
        }

        // Read JSON file
        $json = file_get_contents($path);

        // Convert JSON to array
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function things_to_do_nature_page()
    {
        // JSON file path inside app folder
        $path = app_path('things-to-do-nature.json');

        // Check if file exists
        if (!file_exists($path)) {
            return response()->json([
                'error' => 'things-to-do-nature.json file not found'
            ], 404);
        }

        // Read JSON file
        $json = file_get_contents($path);

        // Convert JSON to array
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function event_details_page()
    {
        // JSON file path inside app folder
        $path = app_path('event-details.json');

        // Check if file exists
        if (!file_exists($path)) {
            return response()->json([
                'error' => 'event-details.json file not found'
            ], 404);
        }

        // Read JSON file
        $json = file_get_contents($path);

        // Convert JSON to array
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function destination_detail_page()
    {
        // JSON file path inside app folder
        $path = app_path('destination-details.json');
        // print_r($path);exit;
        // Check if file exists
        if (!file_exists($path)) {
            return response()->json([
                'error' => 'destination-details.json file not found'
            ], 404);
        }

        // Read JSON file
        $json = file_get_contents($path);

        // Convert JSON to array
        $data = json_decode($json, true);

        return response()->json($data);
    }


}
