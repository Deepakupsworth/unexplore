<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $path = app_path('demojson.json');

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        return view('frontend.home', [
            'heroBanner' => $data['heroBanner'] ?? [], 
            'section2' => $data['section2'] ?? [],
            'section3' => $data['section3'] ?? [],
            'section4' => $data['section4'] ?? [],
            'section5' => $data['section5'] ?? [],   // 🔥 REQUIRED
        ]);
    }

    public function destination_details(Request $request)
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
         $destinations = $data['destination_detail_page'] ?? [];
         $slug = request()->get('slug');
         $destination = collect($destinations)->firstWhere('slug', $slug);
        //  print_r ($destination['city']);
         
        return view('frontend.destination-details',[
            'destinationsss' => $destination, 
        ]);
    }

    public function things_to_do_nature(Request $request)
    {
         // JSON file path inside app folder
         $path = app_path('things-to-do-nature.json');
         // print_r($path);exit;
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
         $things_to_do = $data['things_to_do_nature'] ?? [];
         $slug = request()->get('slug');
         
         $things_to = collect($things_to_do)->firstWhere('slug', $slug);

        //  print_r($things_to['about_blocks']); die;
         
        return view('frontend.things-to-do-nature',[
            'things_to_doss' => $things_to, 
        ]);
    }

    public function event_details(Request $request)
    {
         // JSON file path inside app folder
         $path = app_path('event-details.json');
         // print_r($path);exit;
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
         $event = $data['event_details_page'] ?? [];
         $slug = request()->get('slug');
        
         $event_details = collect($event)->firstWhere('slug', $slug);

    //    print_r($event_details['slug']); die;
         
        return view('frontend.event-details',[
            'event_detailsss' => $event_details, 
        ]);
    }

   
}
