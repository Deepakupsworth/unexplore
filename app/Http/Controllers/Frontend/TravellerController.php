<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Traveller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class TravellerController extends Controller
{
    public function index()
    {
        $travellers = Traveller::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('frontend.account.tabs.travellers', compact('travellers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable',
            'country'    => 'nullable|string|max:100',
            'type'       => 'required|in:adult,child',
        ]);

        $data['user_id'] = auth()->id();

        Traveller::create($data);

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $traveller = Traveller::where('user_id', auth()->id())
            ->findOrFail($id);
    
        return response()->json([
            'id'         => $traveller->id,
            'first_name' => $traveller->first_name,
            'last_name'  => $traveller->last_name,
    
            // ✅ IMPORTANT
            'dob'        => optional($traveller->dob)->format('Y-m-d'),
    
            'gender'     => $traveller->gender,
            'country'    => $traveller->country,
            'type'       => $traveller->type,
            'age'        => $traveller->age,
    
            // for view-only usage
            'dob_text'   => optional($traveller->dob)->format('d M Y'),
            'created_at'=> $traveller->created_at->format('d M Y H:i'),
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $traveller = Traveller::where('user_id', auth()->id())
            ->findOrFail($id);

        $traveller->update($request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'dob'        => 'nullable|date',
            'gender'     => 'nullable',
            'country'    => 'nullable|string|max:100',
            'type'       => 'required|in:adult,child',
        ]));

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Traveller::where('user_id', auth()->id())
            ->findOrFail($id)
            ->delete();

        return response()->json(['success' => true]);
    }
}
