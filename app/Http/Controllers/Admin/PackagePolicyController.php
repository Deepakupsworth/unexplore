<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\PackagePolicy;
use App\Models\PackagePolicyTranslation;
use App\Models\Language;

class PackagePolicyController extends Controller
{
    // List
    public function index(Request $request)
    {
        $policies = PackagePolicy::with('translation')
        ->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString(); // 🔥 keep filters on pagination

        return view('backend.package-policies.index', compact('policies'));
    }

    // Create / Edit form
    public function form($id = null)
    {
        $policy = PackagePolicy::with('translations')->find($id) ?? new PackagePolicy();
        $languages = Language::all();

        return view('backend.package-policies.form', compact('policy', 'languages'));
    }

    // Store / Update (REFERENCE FROM CITY CONTROLLER)
    public function save(Request $request)
    {
        DB::beginTransaction();

        try {

            /** ---------------- NORMALIZE LANG KEYS ---------------- */
            $contents = [];
            foreach ($request->content ?? [] as $key => $value) {
                $contents[strtolower($key)] = $value;
            }
            $request->merge(['content' => $contents]);

            /** ---------------- VALIDATION ---------------- */
            $validator = Validator::make($request->all(), [
                'content.en' => 'required|string', // default language mandatory
                'content.*'  => 'nullable|string',
                'status'     => 'required|in:0,1',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            /** ---------------- CREATE / UPDATE POLICY ---------------- */
            $policy = PackagePolicy::updateOrCreate(
                ['id' => $request->id],
                [
                    'status' => $request->status,
                ]
            );

            /** ---------------- SAVE TRANSLATIONS ---------------- */
            foreach ($request->content as $langCode => $content) {
                if (!empty($content)) {
                    PackagePolicyTranslation::updateOrCreate(
                        [
                            'package_policy_id' => $policy->id,
                            'language_code'     => $langCode,
                        ],
                        [
                            'content' => $content,
                        ]
                    );
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.package-policies.index')
                ->with('success', 'Package policy saved successfully!');
        } catch (Throwable $e) {

            DB::rollBack();

            Log::error('Package policy save failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'data'  => $request->all(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the policy.');
        }
    }

    // Delete
    public function destroy($id)
    {
        PackagePolicy::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Policy deleted successfully.');
    }
}
