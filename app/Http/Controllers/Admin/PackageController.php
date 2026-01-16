<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Category;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /* ================= LIST ================= */

    public function index()
    {
        $packages = Package::with('translation')->latest()->paginate(20);
        return view('backend.packages.index', compact('packages'));
    }

    /* ================= CREATE / EDIT ================= */

    public function create()
    {
        return $this->form(new Package());
    }

    public function edit(Package $package)
    {
        $package->load([
            'translations',
            'availabilities',
            'cities',
            'days.items',
            'price',
            'priceIncreasePersons',
            'childPrices',
            'infos.translations'
        ]);
        return view('backend.packages.form', [
            'package'    => $package,
            'categories' => Category::with('translation')->get(),
            'languages'  => Language::all(),
            'cities'     => City::with('translation')->get(),
        ]);
    }


    private function form(Package $package)
    {
        return view('backend.packages.form', [
            'package'    => $package,
            'categories' => Category::with('translation')->get(),
            'languages'  => Language::all(),
            'cities'     => City::all(),
        ]);
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        return $this->persist($request, new Package());
    }

    /* ================= UPDATE ================= */

    public function update(Request $request, Package $package)
    {
        return $this->persist($request, $package);
    }

    /* ================= CORE SAVE LOGIC ================= */

    private function persist(Request $request, Package $package)
    {
        $request->validate([
            'category_id' => 'required',
            'package_type' => 'required',
            'translations.en.title' => 'required',
            'availability.available_from' => 'required|date',
            'availability.available_to'   => 'required|date',
        ]);

        DB::transaction(function () use ($request, $package) {

            /* ================= PACKAGE ================= */

            $package->fill([
                'category_id'     => $request->category_id,
                'package_type'    => $request->package_type,
                'duration_days'   => $request->duration_days,
                'duration_nights' => $request->duration_nights,
                'base_persons'    => $request->base_persons,
                'max_persons'     => $request->max_persons,
                'status'          => $request->status ?? 'active',
            ]);

            if (!$package->exists) {
                $package->slug = Str::slug($request->translations['en']['title']) . '-' . time();
            }

            $package->save();

            /* ================= TRANSLATIONS ================= */

            $package->translations()->delete();

            foreach ($request->translations as $lang => $data) {
                if (!empty($data['title'])) {
                    $package->translations()->create([
                        'language_code' => $lang,
                        'title'         => $data['title'],
                        'sub_title'     => $data['sub_title'] ?? null,
                        'description'   => $data['description'] ?? null,
                    ]);
                }
            }

            /* ================= AVAILABILITY ================= */

            $package->availabilities()->delete();

            if (
                !empty($request->availability['available_from'])
                && !empty($request->availability['available_to'])
            ) {

                $package->availabilities()->create([
                    'available_from'     => $request->availability['available_from'],
                    'available_to'       => $request->availability['available_to'],
                    'booking_start_date' => $request->availability['booking_start_date'] ?? null,
                    'booking_end_date'   => $request->availability['booking_end_date'] ?? null,
                ]);
            }

            /* ================= CITIES ================= */

            $package->cities()->delete();

            foreach ($request->cities ?? [] as $city) {

                // 🔒 skip empty rows
                if (empty($city['city_id'])) {
                    continue;
                }

                $package->cities()->create([
                    'city_id'    => $city['city_id'],
                    'nights'     => $city['nights'] ?? 0,
                    'sort_order' => $city['sort_order'] ?? 0,
                ]);
            }

            /* ================= ITINERARY ================= */

            $package->days()->delete();

            foreach ($request->itinerary ?? [] as $dayNumber => $dayData) {

                // 🔒 skip if city not selected
                if (empty($dayData['city_id'])) {
                    continue;
                }

                $day = $package->days()->create([
                    'day_number' => $dayNumber,
                    'city_id'    => $dayData['city_id'],
                ]);

                foreach ($dayData['items'] ?? [] as $item) {

                    // 🔒 skip invalid item
                    if (empty($item['item_type']) || empty($item['item_id'])) {
                        continue;
                    }

                    $day->items()->create([
                        'item_type' => $item['item_type'],
                        'item_id'   => $item['item_id'],
                        'start_time' => $item['start_time'] ?? null,
                        'end_time'  => $item['end_time'] ?? null,
                        'sort_order' => $item['sort_order'] ?? 0,
                    ]);
                }
            }

            /* ================= PRICING ================= */

            $package->price()->delete();
            $package->priceIncreasePersons()->delete();
            $package->childPrices()->delete();

            if (
                $request->has('pricing')
                && !empty($request->pricing['original_price'])
                && !empty($request->pricing['per_person_price'])
            ) {

                $package->price()->create([
                    'currency'         => $request->pricing['currency'] ?? 'INR',
                    'original_price'   => $request->pricing['original_price'],
                    'discount_price'   => $request->pricing['discount_price'] ?? null,
                    'per_person_price' => $request->pricing['per_person_price'],
                ]);

                foreach ($request->pricing['extra_persons'] ?? [] as $row) {
                    if (empty($row['person_number']) || empty($row['additional_price'])) {
                        continue;
                    }
                    $package->priceIncreasePersons()->create($row);
                }

                foreach ($request->pricing['child_prices'] ?? [] as $row) {
                    if (
                        empty($row['min_age']) ||
                        empty($row['max_age']) ||
                        empty($row['price_value'])
                    ) {
                        continue;
                    }
                    $package->childPrices()->create($row);
                }
            }

            /* ================= INFO ================= */

            $package->infos()->delete();

            foreach ($request->infos ?? [] as $type => $infoData) {

                $hasContent = collect($infoData['translations'] ?? [])
                    ->whereNotNull('content')
                    ->where('content', '!=', '')
                    ->count();

                if (!$hasContent) {
                    continue;
                }

                $info = $package->infos()->create([
                    'type' => $type,
                ]);

                foreach ($infoData['translations'] ?? [] as $lang => $content) {
                    if (!empty($content['content'])) {
                        $info->translations()->create([
                            'language_code' => $lang,
                            'title'         => $content['title'],
                            'content'       => $content['content'],
                        ]);
                    }
                }
            }
        });

        return redirect()
            ->route('admin.packages.edit', $package)
            ->with('success', 'Package saved successfully');
    }
}
