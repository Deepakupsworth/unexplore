<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    // List Page
    public function index(Request $request)
    {
        $query = Country::query();

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('code', 'like', '%' . $request->search . '%')
                    ->orWhere('currency_code', 'like', '%' . $request->search . '%');
            });
        }

        // Status filter
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $countries = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('backend.countries.index', compact('countries'));
    }

    // Create form
    public function create()
    {
        $country = new Country();   // empty model
        return view('backend.countries.form', compact('country'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:10|unique:countries,code',
            'currency_code' => 'required|string|max:10',
            'status' => 'required|boolean',
        ]);

        Country::create($request->all());

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country created successfully');
    }

    // Edit form
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('backend.countries.form', compact('country'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'code' => ['required', 'string', 'max:10', Rule::unique('countries')->ignore($country->id)],
            'currency_code' => 'required|string|max:10',
            'status' => 'required|boolean',
        ]);

        $country->update($request->all());

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country updated successfully');
    }

    // Delete
    public function destroy($id)
    {
        Country::findOrFail($id)->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', 'Country deleted successfully');
    }

    // Toggle status (AJAX)
    public function toggleStatus($id)
    {
        $country = Country::findOrFail($id);
        $country->status = !$country->status;
        $country->save();

        return response()->json([
            'status' => $country->status
        ]);
    }
}
