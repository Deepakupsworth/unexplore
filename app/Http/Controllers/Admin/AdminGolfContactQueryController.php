<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GolfContactQuery;

class AdminGolfContactQueryController extends Controller
{

    // list queries
    public function index(Request $request)
    {

        $query = GolfContactQuery::query();

        // optional status filter
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // search by email or name
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $queries = $query->latest()->paginate(20);

        return view('backend.golfquery.index', compact('queries'));
    }


    // view single query
    public function show($id)
    {
        $query = GolfContactQuery::findOrFail($id);

        // mark as in_progress
        if ($query->status == 'new') {
            $query->update(['status' => 'in_progress']);
        }

        return view('backend.golfquery.show', compact('query'));
    }


    // delete query
    public function destroy($id)
    {
        $query = GolfContactQuery::findOrFail($id);

        $query->delete();

        return redirect()->back()->with('success', 'Query deleted successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        //print_r($request->all());die;
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved'
        ]);

        $query = GolfContactQuery::findOrFail($id);

        $query->update([
            'status' => $request->status
        ]);
        //print_r($query);die;

        return back()->with('success', 'Status updated successfully');
    }

}