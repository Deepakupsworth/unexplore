<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CategoryType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventTranslation;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Helpers\TimeHelper;
use App\Models\EventCategory;
use App\Models\Tag;
use Throwable;

class EventController extends Controller
{
    /* =========================
     |  LIST
     ========================= */
    public function index(Request $request)
    {
        $events = Event::with(['translations', 'city', 'thumb'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->whereHas(
                    'translations',
                    fn($t) =>
                    $t->where('language_code', 'en')
                        ->where('title', 'like', "%{$request->search}%")
                );
            })
            ->when(
                $request->filled('city_id'),
                fn($q) =>
                $q->where('city_id', $request->city_id)
            )
            ->when(
                $request->filled('status'),
                fn($q) =>
                $q->where('status', $request->status)
            )
            ->when(
                $request->filled('start_date'),
                fn($q) =>
                $q->whereDate('start_date', '>=', $request->start_date)
            )
            ->when(
                $request->filled('end_date'),
                fn($q) =>
                $q->whereDate('end_date', '<=', $request->end_date)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $cities = City::pluck('slug', 'id');

        return view('backend.events.index', compact('events', 'cities'));
    }

    /* =========================
     |  FORM
     ========================= */
    public function form($id = null)
    {
        $model = Event::with(['translations', 'gallery', 'thumb','tags'])
            ->find($id) ?? new Event();

        return view('backend.events.form', [
            'model'      => $model,
            'languages'  => Language::all(),
            'cities'     => City::pluck('slug', 'id'),
            'categories' => Category::where('type', CategoryType::EVENT)
                ->with('translation')
                ->get(),
            'tags' => Tag::orderBy('name')->get()
        ]);
    }

    /* =========================
     |  SHOW
     ========================= */
    public function show($id)
    {
        $event = Event::with([
            'translations',
            'city',
            'category.translation',
            'eventCategories.category.translation',
            'gallery',
            'thumb'
        ])->findOrFail($id);

        return view('backend.events.show', compact('event'));
    }

    /* =========================
     |  SAVE (CREATE / UPDATE)
     ========================= */
    // public function save(Request $request)
    // {
    //     // Normalize time
    //     $request->merge([
    //         'opening_time' => $request->opening_time && str_contains($request->opening_time, 'M')
    //             ? TimeHelper::to24Hour($request->opening_time)
    //             : $request->opening_time,

    //         'closing_time' => $request->closing_time && str_contains($request->closing_time, 'M')
    //             ? TimeHelper::to24Hour($request->closing_time)
    //             : $request->closing_time,
    //     ]);

    //     $validated = $request->validate([
    //         // TRANSLATIONS
    //         'translations.en.title'       => 'required|string|max:255',
    //         'translations.en.url'         => 'required|string|max:255',
    //         'translations.*.title'        => 'nullable|string|max:255',
    //         'translations.*.sub_title'    => 'nullable|string|max:255',
    //         'translations.*.description'  => 'nullable|string',
    //         'translations.*.url'          => 'nullable|string|max:255',

    //         // BASIC
    //         'city_id'     => 'required|exists:cities,id',
    //         'category_id' => 'required|exists:categories,id',
    //         'capacity'    => 'nullable|integer|min:1',
    //         'location'    => 'nullable|string|max:255',

    //         // DATE / TIME
    //         'start_date'   => 'nullable|date',
    //         'end_date'     => 'nullable|date|after_or_equal:start_date',
    //         'opening_days' => 'nullable|string|max:255',
    //         'opening_time' => 'nullable|date_format:H:i',
    //         'closing_time' => 'nullable|date_format:H:i',


    //         // MAP
    //         'latitude'  => 'nullable|numeric|between:-90,90',
    //         'longitude' => 'nullable|numeric|between:-180,180',

    //         // MEDIA
    //         // 'thumb'     => 'nullable|image|max:2048',
    //         // 'gallery.*' => 'nullable|image|max:2048',

    //         // META
    //         'video_url' => 'nullable|url',
    //         'url'       => 'nullable|url',
    //         'status'    => 'required|in:0,1',
    //     ]);

    //     DB::beginTransaction();

    //     try {

    //         /** ---------------- EVENT DATA ---------------- */
    //         $eventData = [
    //             'slug'         => Str::slug($validated['translations']['en']['title']),
    //             'start_date'   => $validated['start_date'] ?? null,
    //             'end_date'     => $validated['end_date'] ?? null,
    //             'opening_days' => $validated['opening_days'] ?? null,
    //             'opening_time' => $validated['opening_time'] ?? null,
    //             'closing_time' => $validated['closing_time'] ?? null,
    //             'city_id'      => $validated['city_id'],
    //             'category_id'  => $validated['category_id'],
    //             'capacity'     => $validated['capacity'] ?? null,
    //             'location'     => $validated['location'] ?? null,
    //             'latitude'     => $validated['latitude'] ?? null,
    //             'longitude'    => $validated['longitude'] ?? null,
    //             'video_url'    => $validated['video_url'] ?? null,
    //             'url'          => $validated['url'] ?? null,
    //             'status'       => $validated['status'],
    //         ];

    //         /** ---------------- CREATE / UPDATE ---------------- */
    //         if ($request->filled('id')) {
    //             $event = Event::findOrFail($request->id);
    //             $event->update($eventData);
    //         } else {
    //             $event = Event::create($eventData);
    //         }

    //         /** ---------------- TRANSLATIONS ---------------- */
    //         foreach ($validated['translations'] as $lang => $data) {
    //             if (!empty($data['title'])) {
    //                 EventTranslation::updateOrCreate(
    //                     [
    //                         'event_id'      => $event->id,
    //                         'language_code' => strtolower($lang),
    //                     ],
    //                     [
    //                         'title'       => $data['title'],
    //                         'sub_title'   => $data['sub_title'] ?? null,
    //                         'description' => $data['description'] ?? null,
    //                         'url'         => $data['url'] ?? null,
    //                     ]
    //                 );
    //             }
    //         }

    //         /** ---------------- THUMB ---------------- */
    //         if ($request->hasFile('thumb')) {
    //             optional($event->thumb)->delete();
    //             storeImage($event, $request->thumb, 'events/thumbs', 'thumb', 'en', true);
    //         }

    //         /** ---------------- GALLERY ---------------- */
    //         if ($request->hasFile('gallery')) {
    //             foreach ($request->gallery as $img) {
    //                 storeImage($event, $img, 'events/gallery', 'gallery');
    //             }
    //         }

    //         DB::commit();

    //         return redirect()
    //             ->route('events.index')
    //             ->with('success', 'Event saved successfully');
    //     } catch (\Throwable $e) {

    //         DB::rollBack();

    //         Log::error('Event save failed', [
    //             'error' => $e->getMessage(),
    //             'file'  => $e->getFile(),
    //             'line'  => $e->getLine(),
    //         ]);

    //         return back()
    //             ->withInput()
    //             ->with('error', 'Something went wrong. Please try again.');
    //     }
    // }


    public function save(Request $request)
    {
        /** ---------------- NORMALIZE TIME ---------------- */
        $request->merge([
            'opening_time' => $request->opening_time && str_contains($request->opening_time, 'M')
                ? TimeHelper::to24Hour($request->opening_time)
                : $request->opening_time,

            'closing_time' => $request->closing_time && str_contains($request->closing_time, 'M')
                ? TimeHelper::to24Hour($request->closing_time)
                : $request->closing_time,
        ]);

        /** ---------------- VALIDATION ---------------- */
        $validated = $request->validate([
            // TRANSLATIONS
            'translations.en.title'       => 'required|string|max:255',
            'translations.en.url'         => 'required|string|max:255',
            'translations.*.title'        => 'nullable|string|max:255',
            'translations.*.sub_title'    => 'nullable|string|max:255',
            'translations.*.description'  => 'nullable|string',
            'translations.*.url'          => 'nullable|string|max:255',

            // BASIC
            'city_id'     => 'required|exists:cities,id',

            // ✅ MULTI CATEGORY
            'category_ids'   => 'required|array|min:1',
            'category_ids.*' => 'exists:categories,id',

            'capacity'    => 'nullable|integer|min:1',
            'location'    => 'nullable|string|max:255',

            // DATE / TIME
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'opening_days' => 'nullable|string|max:255',
            'opening_time' => 'nullable|date_format:H:i',
            'closing_time' => 'nullable|date_format:H:i',

            // MAP
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            // META
            'video_url' => 'nullable|url',
            'url'       => 'nullable|url',
            'status'    => 'required|in:0,1',
        ]);

        DB::beginTransaction();

        try {

            /** ---------------- EVENT DATA ---------------- */
            $eventData = [
                'slug'         => Str::slug($validated['translations']['en']['title']),
                'start_date'   => $validated['start_date'] ?? null,
                'end_date'     => $validated['end_date'] ?? null,
                'opening_days' => $validated['opening_days'] ?? null,
                'opening_time' => $validated['opening_time'] ?? null,
                'closing_time' => $validated['closing_time'] ?? null,
                'city_id'      => $validated['city_id'],
                'capacity'     => $validated['capacity'] ?? null,
                'location'     => $validated['location'] ?? null,
                'latitude'     => $validated['latitude'] ?? null,
                'longitude'    => $validated['longitude'] ?? null,
                'video_url'    => $validated['video_url'] ?? null,
                'url'          => $validated['url'] ?? null,
                'status'       => $validated['status'],
            ];

            /** ---------------- CREATE / UPDATE EVENT ---------------- */
            if ($request->filled('id')) {
                $event = Event::findOrFail($request->id);
                $event->update($eventData);
            } else {
                $event = Event::create($eventData);
            }

            /** ---------------- TRANSLATIONS ---------------- */
            foreach ($validated['translations'] as $lang => $data) {
                if (!empty($data['title'])) {
                    EventTranslation::updateOrCreate(
                        [
                            'event_id'      => $event->id,
                            'language_code' => strtolower($lang),
                        ],
                        [
                            'title'       => $data['title'],
                            'sub_title'   => $data['sub_title'] ?? null,
                            'description' => $data['description'] ?? null,
                            'url'         => $data['url'] ?? null,
                        ]
                    );
                }
            }

            /** ---------------- MULTI CATEGORY SAVE (EventCategory MODEL) ---------------- */
            EventCategory::where('event_id', $event->id)->delete();

            foreach ($validated['category_ids'] as $categoryId) {
                EventCategory::create([
                    'event_id'    => $event->id,
                    'category_id' => $categoryId,
                ]);
            }

            /** ---------------- MEDIA ---------------- */
            if ($request->hasFile('thumb')) {
                optional($event->thumb)->delete();
                storeImage($event, $request->thumb, 'events/thumbs', 'thumb', 'en', true);
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->gallery as $img) {
                    storeImage($event, $img, 'events/gallery', 'gallery');
                }
            }

            /* ================= TAGS ================= */
            if ($request->filled('tags')) {
                $event->tags()->sync($request->tags);
            } else {
                $event->tags()->detach();
            }


            DB::commit();

            return redirect()
                ->route('events.index')
                ->with('success', 'Event saved successfully');
        } catch (Throwable $e) {

            DB::rollBack();

            Log::error('Event save failed', [
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }



    /* =========================
     |  DELETE
     ========================= */
    public function delete($id)
    {
        try {
            $event = Event::with('images')->findOrFail($id);

            foreach ($event->images as $img) {
                Storage::disk('public')->delete($img->image_path);
            }

            $event->delete();

            return back()->with('success', 'Event deleted successfully');
        } catch (Throwable $e) {

            Log::error('Event delete failed', [
                'event_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Unable to delete event');
        }
    }
}
