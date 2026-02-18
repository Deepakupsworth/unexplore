<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompanyDetailController extends Controller
{

    /**
     * List company details
     */
    public function index(Request $request)
    {
        $query = CompanyDetail::query();

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('company_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        $companies = $query->latest()->paginate(10)->withQueryString();

        return view('backend.company.index', compact('companies'));
    }
    /**
     * Single form (create/edit)
     */
    public function form()
    {
        $model = CompanyDetail::first() ?? new CompanyDetail();

        return view('backend.company.form', compact('model'));
    }

    /**
     * Save (create/update)
     */
    public function save(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|string|max:20',
            'whatsapp'     => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $company = CompanyDetail::first();

            if (! $company) {
                $company = new CompanyDetail();
            }

            $company->fill($request->only([
                'company_name',
                'email',
                'phone',
                'whatsapp',
                'address_line',
                'city',
                'country',
                'postal_code',
                'working_days',
                'working_hours',
                'instagram_url',
                'facebook_url',
                'twitter_url',
            ]));

            $company->save();

            DB::commit();

            return redirect()
                ->route('admin.company-details.form')
                ->with('success', 'Company details saved successfully!');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Company details save failed', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving.');
        }
    }
}
