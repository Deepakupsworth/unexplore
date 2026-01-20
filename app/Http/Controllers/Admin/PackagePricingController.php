<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackagePricingController extends Controller
{
    /* ================= EDIT ================= */
    public function edit(Package $package)
    {
        $package->load([
            'price',
            'priceIncreasePersons',
            'childPrices',
        ]);

        return view('backend.packages.pricing.edit', compact('package'));
    }

    /* ================= SAVE / UPDATE ================= */
    public function update(Request $request, Package $package)
    {

        // dd($request->all());
        $request->validate([
            'extra_persons.*.person_number' => 'required|integer|min:1',
            'extra_persons.*.additional_price' => 'required|numeric|min:0',
            'child_prices.*.min_age' => 'required|integer',
            'child_prices.*.max_age' => 'required|integer',
        ]);
        DB::transaction(function () use ($request, $package) {

            /* ---------- EXTRA PERSON PRICE ---------- */
            $package->priceIncreasePersons()->delete();

            foreach ($request->extra_persons ?? [] as $row) {
                if (!empty($row['person_number']) && !empty($row['additional_price'])) {
                    $package->priceIncreasePersons()->create([
                        'person_number'    => $row['person_number'],
                        'additional_price' => $row['additional_price'],
                    ]);
                }
            }

            /* ---------- CHILD PRICE ---------- */
            $package->childPrices()->delete();

            foreach ($request->child_prices ?? [] as $row) {
                if (
                    isset(
                        $row['min_age'],
                        $row['max_age'],
                        $row['price_type'],
                        $row['price_value']
                    )
                ) {
                    $package->childPrices()->create([
                        'min_age'     => $row['min_age'],
                        'max_age'     => $row['max_age'],
                        'price_type'  => $row['price_type'],
                        'price_value' => $row['price_value'],
                    ]);
                }
            }
        });

        return redirect()
            ->back()
            ->with('success', 'Pricing updated successfully');
    }
}
