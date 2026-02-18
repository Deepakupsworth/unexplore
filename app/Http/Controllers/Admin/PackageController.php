<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/* MODELS */
use App\Models\Package;
use App\Models\Category;
use App\Models\City;
use App\Models\Language;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\PackageCategory;
use App\Models\PackageDayItem;
use App\Models\PackageDayItemOption;
use App\Models\PackagePolicy;
use App\Models\Tag;
use App\Models\ThingToDo;
use App\Models\Transport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    /* ================= LIST ================= */
    public function index(Request $request)
    {
        $packages = Package::query()
            ->with([
                'translations',
                'category.translation',
                'packageCategories.category.translation',
                'thumb',
            ])

            // 🔍 SEARCH (TITLE)
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas(
                    'translations',
                    fn($t) =>
                    $t->where('title', 'like', '%' . $request->search . '%')
                );
            })

            // 📦 PACKAGE TYPE
            ->when($request->package_type, function ($q) use ($request) {
                $q->where('package_type', $request->package_type);
            })

            // 📂 CATEGORY
            ->when($request->category_id, function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            })

            // ⚡ STATUS
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })

            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('backend.packages.index', compact('packages'));
    }


    /* ================= CREATE ================= */
    public function create()
    {
        return $this->createForm();
    }

    /* ================= EDIT ================= */
    public function edit(Package $package)
    {
        $package->load([
            'translations',
            'availabilities',
            'cities',
            'days.items',
            'price',
            'infos.translations',
            'thumb',
            'gallery',
            'tags'
        ]);
        return $this->editForm($package);
    }

    public function show(Package $package)
    {
        $lang = app()->getLocale();

        $package->load([
            'translations',
            'policies.translation',
            'category.translation',
            'packageCategories.category.translation',
            'availabilities',
            'cities.city',
            'days.items',
            'days.options',

            // 🔥 LOAD OPTION RELATIONS
            'days.options.hotel.translation',
            'days.options.hotel.thumb',

            'days.options.todo.translation',
            'days.options.todo.thumb',

            'days.options.event.translation',
            'days.options.event.thumb',

            'days.options.transport.translation',
            'days.options.transport.thumb',

            'price',
            'price.childPrices',          // ✅ FIX
            'price.increasePersons',

            'infos.translations',
            'thumb',
            'gallery',

        ]);


        $languages = Language::select('id', 'code')->get();

        // 🔥 ALL ACTIVE POLICIES (for checkbox list)
        $policies = PackagePolicy::with([
            'translation' => fn($q) => $q->where('language_code', $lang)
        ])
            ->where('status', 1)
            ->get();


        // Already used MAIN day items (hotel/todo/event)
        $dayItems = \App\Models\PackageDayItem::select(
            'package_day_id',
            'item_type',
            'item_id'
        )
            ->get()
            ->groupBy(fn($i) => $i->package_day_id . '_' . $i->item_type);

        // Already added OPTIONS
        $usedOptions = \App\Models\PackageDayItemOption::select(
            'package_day_id',
            'item_type',
            'item_id'
        )
            ->get()
            ->groupBy(fn($o) => $o->package_day_id . '_' . $o->item_type);

        return view('backend.packages.show', [

            'package'     => $package,
            'dayItems'    => $dayItems,
            'usedOptions' => $usedOptions,
            'languages'   => $languages,
            'policies'    => $policies,

            // ================= MODAL DATA =================

            'hotels' => \App\Models\Hotel::with([
                'translations' => fn($q) =>
                $q->where('language_code', $lang)
            ])->get()->map(fn($h) => [
                'id'   => $h->id,
                'name' => $h->translations->first()->name ?? 'Hotel #' . $h->id,
            ]),

            'events' => \App\Models\Event::with([
                'translations' => fn($q) =>
                $q->where('language_code', $lang)
            ])->get()->map(fn($e) => [
                'id'   => $e->id,
                'name' => $e->translations->first()->title ?? 'Event #' . $e->id,
            ]),

            'todos' => \App\Models\ThingToDo::with([
                'translations' => fn($q) =>
                $q->where('language_code', $lang)
            ])->get()->map(fn($t) => [
                'id'   => $t->id,
                'name' => $t->translations->first()->name ?? 'Todo #' . $t->id,
            ]),

            'transports' => \App\Models\Transport::with([
                'translations' => fn($q) =>
                $q->where('language_code', $lang)
            ])->get()->map(fn($t) => [
                'id'   => $t->id,
                'name' => $t->translations->first()->name ?? 'Todo #' . $t->id,
            ]),
        ]);
    }


    /* ================= CREATE FORM ================= */
    private function createForm()
    {
        return view('backend.packages.form', $this->commonFormData());
    }

    /* ================= EDIT FORM ================= */
    private function editForm(Package $package)
    {

        return view('backend.packages.edit', array_merge(
            $this->commonFormData(),
            ['package' => $package]
        ));
    }

    /* ================= COMMON FORM DATA ================= */
    private function commonFormData(): array
    {
        // Normalize language once
        $lang = strtolower(app()->getLocale() ?? 'en');

        // Reusable translation filter (case-insensitive)
        $translationFilter = fn($q) =>
        $q->whereRaw('LOWER(language_code) = ?', [$lang]);

        return [
            'categories' => Category::where('type', CategoryType::PACKAGE)
                ->with('translation')
                ->get(),

            'languages' => Language::select('id', 'code')->get(),

            'cities' => City::select('id', 'slug')->get(),

            'hotels' => Hotel::with([
                'translations' => $translationFilter
            ])->get()->map(fn($h) => [
                'id'   => $h->id,
                'name' => optional($h->translations->first())->name
                    ?? 'Hotel #' . $h->id,
            ]),

            'events' => Event::with([
                'translations' => $translationFilter
            ])->get()->map(fn($e) => [
                'id'   => $e->id,
                'name' => optional($e->translations->first())->title
                    ?? 'Event #' . $e->id,
            ]),

            'todos' => ThingToDo::with('translation')->get()->map(fn($t) => [
                'id'   => $t->id,
                'name' => optional($t->translation)->name
                    ?? 'Todo #' . $t->id,
            ]),


            'transports' => Transport::with([
                'translations' => $translationFilter
            ])->get()->map(fn($t) => [
                'id'   => $t->id,
                'name' => optional($t->translations->first())->name
                    ?? 'Transport #' . $t->id,
            ]),

            'tags' => Tag::orderBy('name')->get()
        ];
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

    /* ================= SAVE LOGIC ================= */
    private function persist(Request $request, Package $package)
    {
        $request->validate([
            'tags'   => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',

            'package_type'    => 'required|in:fixed,customized',
            'duration_days'   => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'max_persons'     => 'required|integer|min:1',

            'availability.available_from' => 'required|date',
            'availability.available_to'   => 'required|date|after_or_equal:availability.available_from',

            'pricing.currency'         => 'required|string|size:3',
            'pricing.original_price'   => 'required|numeric|min:0',
            'pricing.per_person_price' => 'required|numeric|min:0',

            // 'thumb'     => 'nullable|image|max:2048',
            // 'gallery'   => 'nullable|array',
            // 'gallery.*' => 'image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            /* ================= PACKAGE ================= */
            $package->fill([
                'package_type'    => $request->package_type,
                'duration_days'   => $request->duration_days,
                'duration_nights' => $request->duration_nights,
                'base_persons'    => $request->base_persons ?? 2,
                'max_persons'     => $request->max_persons,
                'status'          => $request->status ?? 'draft',
            ]);

            if (!$package->exists) {

                $currentLang = strtolower(app()->getLocale() ?? 'en');

                // 1️⃣ Try current language title
                $title = $request->translations[$currentLang]['title'] ?? null;

                // 2️⃣ Fallback: first non-empty title
                if (empty($title)) {
                    $title = collect($request->translations)
                        ->pluck('title')
                        ->filter()
                        ->first();
                }

                // 3️⃣ Final safety
                if (empty($title)) {
                    $title = 'package';
                }

                $package->slug = Str::slug($title) . '-' . time();
            }


            $package->save();


            /* ================= PACKAGE CATEGORIES (MULTI) ================= */
            PackageCategory::where('package_id', $package->id)->delete();

            foreach ($request->category_ids as $categoryId) {
                PackageCategory::create([
                    'package_id'  => $package->id,
                    'category_id' => $categoryId,
                ]);
            }

            /* ================= TRANSLATIONS ================= */
            $package->translations()->delete();

            foreach ($request->translations as $lang => $tr) {
                if (!empty($tr['title'])) {
                    $package->translations()->create([
                        'language_code' => strtolower($lang),
                        'title'         => $tr['title'],
                        'sub_title'     => $tr['sub_title'] ?? null,
                        'description'   => $tr['description'] ?? null,
                    ]);
                }
            }

            /* ================= AVAILABILITY ================= */
            $package->availabilities()->delete();
            $package->availabilities()->create($request->availability);

            /* ================= CITIES ================= */
            $package->cities()->delete();

            foreach ($request->cities ?? [] as $row) {
                if (empty($row['city_id'])) continue;

                $package->cities()->create([
                    'city_id'    => $row['city_id'],
                    'nights'     => $row['nights'] ?? 1,
                    'sort_order' => $row['sort_order'] ?? 0,
                ]);
            }

            /* ================= DAYS & ITEMS ================= */
            $package->days()->delete();

            foreach ($request->days ?? [] as $dayNo => $day) {
                if (empty($day['city_id'])) continue;

                $dayModel = $package->days()->create([
                    'day_number' => $dayNo,
                    'city_id'    => $day['city_id'],
                ]);

                foreach ($day['items'] ?? [] as $item) {
                    if (empty($item['item_type']) || empty($item['item_id'])) continue;

                    $dayModel->items()->create([
                        'item_type'  => $item['item_type'],
                        'item_id'    => $item['item_id'],
                        'start_time' => $item['start_time'] ?? null,
                        'end_time'   => $item['end_time'] ?? null,
                        'sort_order' => $item['sort_order'] ?? 0,
                    ]);
                }
            }

            /* ================= PRICING ================= */
            $package->price()->delete();
            $package->price()->create($request->pricing);

            /* ================= ADDITIONAL INFO ================= */
            $package->infos()->delete();

            foreach ($request->infos ?? [] as $info) {

                if (empty($info['type'])) continue;

                $hasContent = collect($info['translations'] ?? [])
                    ->whereNotNull('content')
                    ->where('content', '!=', '')
                    ->count();

                if (!$hasContent) continue;

                $infoModel = $package->infos()->create([
                    'type' => $info['type']
                ]);

                foreach ($info['translations'] ?? [] as $lang => $tr) {
                    if (!empty($tr['content'])) {
                        $infoModel->translations()->create([
                            'language_code' => strtolower($lang),
                            'title'         => $tr['title'] ?? null,
                            'content'       => $tr['content'],
                        ]);
                    }
                }
            }

            /* ================= MEDIA ================= */
            if ($request->hasFile('thumb')) {
                if ($package->thumb) {
                    Storage::disk('public')->delete($package->thumb->image_path);
                    $package->thumb()->delete();
                }
                storeImage($package, $request->thumb, 'package/thumbs', 'thumb', 'en', true);
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->gallery as $img) {
                    storeImage($package, $img, 'package/gallery', 'gallery');
                }
            }


            /* ================= TAGS ================= */
            if ($request->has('tags')) {
                $package->tags()->sync($request->tags);
            } else {
                $package->tags()->detach();
            }


            DB::commit();

            return redirect()
                ->route('admin.packages.index')
                ->with('success', 'Package saved successfully');
        } catch (\Throwable $e) {

            DB::rollBack();

            // 🔥 Log exact error for debugging
            Log::error('Package Save Failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while saving the package.');
        }
    }

    public function packageDayOptionsStore(Request $request)
    {
        $request->validate([
            'package_day_id' => 'required|exists:package_days,id',
            'item_type'      => 'required|in:hotel,event,todo,transport',
            'item_id'        => 'required|integer',
            'extra_price'    => 'nullable|numeric|min:0',
            'is_default'     => 'nullable|boolean',
        ]);

        // ❌ 1. BLOCK: already exists in DAY ITEMS
        $existsInDay = PackageDayItem::where([
            'package_day_id' => $request->package_day_id,
            'item_type'      => $request->item_type,
            'item_id'        => $request->item_id,
        ])->exists();

        if ($existsInDay) {
            return response()->json([
                'message' => 'Item already exists in day plan'
            ], 422);
        }

        // ❌ 2. BLOCK: already exists as OPTION
        $existsInOption = PackageDayItemOption::where([
            'package_day_id' => $request->package_day_id,
            'item_type'      => $request->item_type,
            'item_id'        => $request->item_id,
        ])->exists();

        if ($existsInOption) {
            return response()->json([
                'message' => 'Option already added'
            ], 422);
        }

        // 🔥 3. AUTO SORT ORDER (per day + item_type)
        $nextSortOrder = PackageDayItemOption::where(
            'package_day_id',
            $request->package_day_id
        )
            ->where('item_type', $request->item_type)
            ->max('sort_order');

        // ✅ 4. CREATE OPTION
        PackageDayItemOption::create([
            'package_day_id' => $request->package_day_id,
            'item_type'      => $request->item_type,
            'item_id'        => $request->item_id,
            'extra_price'    => $request->extra_price ?? 0,
            'is_default'     => $request->boolean('is_default'),
            'sort_order'     => ($nextSortOrder ?? 0) + 1,
        ]);

        return response()->json([
            'message' => 'Optional item added successfully'
        ]);
    }


    public function packageDayOptionsDestroy(PackageDayItemOption $option)
    {
        $option->delete();

        return response()->json([
            'message' => 'Optional item removed successfully'
        ]);
    }

    public function saveAdditionalInfo(Request $request, Package $package)
    {
        $request->validate([
            'infos' => 'required|array',
            'infos.*.type' => 'required|string|max:255',
            'infos.*.translations' => 'required|array',
        ]);

        // 🔥 clean old
        $package->infos()->delete();

        foreach ($request->infos as $infoData) {

            $info = $package->infos()->create([
                'type' => $infoData['type'],
            ]);

            foreach ($infoData['translations'] as $lang => $tr) {

                if (empty($tr['title']) && empty($tr['content'])) {
                    continue;
                }

                $info->translations()->create([
                    'language_code' => $lang,
                    'title'   => $tr['title'] ?? '',
                    'content' => $tr['content'] ?? '',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Additional info saved');
    }


    public function savePolicies(Request $request, Package $package)
    {
        // checkbox se aayega: policies[] = [1,2,3]
        $policyIds = $request->input('policies', []);

        // attach / detach automatically
        $package->policies()->sync($policyIds);

        return back()->with('success', 'Package policies updated successfully.');
    }


    public function search(Request $request)
    {
        return Package::query()
            ->whereHas('translation', function ($t) use ($request) {
                $t->where('title', 'like', '%' . $request->q . '%');
            })
            ->with(['translation'])
            ->limit(10)
            ->get()
            ->map(function ($package) {
                return [
                    'id' => $package->id,
                    'title' => optional($package->translation->first())->title
                ];
            });
    }

    public function seachIds(Request $request)
    {
        return Package::whereIn('id', $request->ids)
            ->with('translation')
            ->get()
            ->map(function ($package) {
                return [
                    'id' => $package->id,
                    'title' => optional($package->translation->first())->title
                ];
            });
    }



}
