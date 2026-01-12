<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{

public function destination_details(Request $request)
{
   // GET se slug lena
   $slug = $request->get('slug');

   if (!$slug) {
       abort(404);
   }

   // Public JSON file path
   $path = public_path('destinations-details.json');

   if (!file_exists($path)) {
       abort(404, 'JSON file not found');
   }

   // JSON read
   $json = file_get_contents($path);
   $destinations = json_decode($json, true);

   // Slug match
   $destination = collect($destinations)->firstWhere('slug', $slug);

   if (!$destination) {
       abort(404);
   }

   return view('frontend.destination-details', compact('destination'));
} 
}