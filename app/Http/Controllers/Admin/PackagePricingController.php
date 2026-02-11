<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageChildPrice;
use App\Models\PackagePriceIncreasePerson;
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
        $request->validate([
            'extra_persons'                     => 'nullable|array',
            'extra_persons.*.id'                => 'nullable|integer',
            'extra_persons.*.person_number'     => 'nullable|integer|min:1',
            'extra_persons.*.additional_price'  => 'nullable|numeric|min:0',

            'child_prices'                      => 'nullable|array',
            'child_prices.*.id'                 => 'nullable|integer',
            'child_prices.*.min_age'            => 'nullable|integer',
            'child_prices.*.max_age'            => 'nullable|integer',
            'child_prices.*.price_type'         => 'nullable|string',
            'child_prices.*.price_value'        => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $package) {

            /* ================= EXTRA PERSON ================= */

            foreach ($request->extra_persons ?? [] as $row) {

                if (empty($row['person_number']) || empty($row['additional_price'])) {
                    continue;
                }

                if (!empty($row['id'])) {
                    // Update
                    $package->priceIncreasePersons()
                        ->where('id', $row['id'])
                        ->update([
                            'person_number'    => $row['person_number'],
                            'additional_price' => $row['additional_price'],
                        ]);
                } else {
                    // Create
                    $package->priceIncreasePersons()->create([
                        'person_number'    => $row['person_number'],
                        'additional_price' => $row['additional_price'],
                    ]);
                }
            }

            /* ================= CHILD PRICE ================= */

            foreach ($request->child_prices ?? [] as $row) {

                if (
                    empty($row['min_age']) ||
                    empty($row['max_age']) ||
                    empty($row['price_type']) ||
                    empty($row['price_value'])
                ) {
                    continue;
                }

                if (!empty($row['id'])) {
                    // Update
                    $package->childPrices()
                        ->where('id', $row['id'])
                        ->update([
                            'min_age'     => $row['min_age'],
                            'max_age'     => $row['max_age'],
                            'price_type'  => $row['price_type'],
                            'price_value' => $row['price_value'],
                        ]);
                } else {
                    // Create
                    $package->childPrices()->create([
                        'min_age'     => $row['min_age'],
                        'max_age'     => $row['max_age'],
                        'price_type'  => $row['price_type'],
                        'price_value' => $row['price_value'],
                    ]);
                }
            }
        });

        return back()->with('success', 'Pricing updated successfully');
    }

    public function deleteExtraPerson($id)
    {
        $person = PackagePriceIncreasePerson::findOrFail($id);

        $person->delete();

        return response()->json([
            'success' => true,
            'message' => 'Extra person removed successfully'
        ]);
    }

    public function deleteChildPrice($id)
    {
        $child = PackageChildPrice::findOrFail($id);

        $child->delete();

        return response()->json([
            'success' => true,
            'message' => 'Child price removed successfully'
        ]);
    }
}
