<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GolfContactQuery;
use Illuminate\Http\Request;


class GolfContactQueryController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        GolfContactQuery::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'golf_id' => $request->golf_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Query submitted'
        ]);

    }

}