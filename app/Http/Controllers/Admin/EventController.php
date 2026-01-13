<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTranslation;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // List
    public function index()
    {
        $events = Event::with(['en', 'city', 'thumb'])->paginate(10);
        return view('backend.events.index', compact('events'));
    }

    // Form
    public function form($id = null)
    {
        $model = Event::with(['translations', 'gallery', 'thumb'])->find($id) ?? new Event();
        $languages = Language::all();
        $cities = City::pluck('slug', 'id');

        return view('backend.events.form', compact('model', 'languages', 'cities'));
    }

    // Save
    public function save(Request $request)
    {
        $request->validate([
            'translations.en.title' => 'required|string|max:255',
            'translations.en.url'   => 'required|string|max:255',
        ]);

        // Save event
        $event = Event::updateOrCreate(
            ['id' => $request->id],
            [
                'slug'         => $request->slug ?? Str::slug($request->translations['en']['title']),
                'start_date'   => $request->start_date,
                'end_date'     => $request->end_date,
                'opening_days' => $request->opening_days,
                'opening_time' => $request->opening_time,
                'closing_time' => $request->closing_time,
                'city_id'      => $request->city_id,
                'capacity'     => $request->capacity,
                'status'       => $request->status ?? 1,
                'location'     => $request->location,
                'latitude'     => $request->latitude,
                'longitude'    => $request->longitude,
                'video_url'    => $request->video_url,
            ]
        );

        // Save translations
        foreach ($request->translations as $lang => $data) {
            if (!empty($data['title'])) {
                EventTranslation::updateOrCreate(
                    [
                        'event_id'     => $event->id,
                        'language_code' => strtolower($lang),
                    ],
                    [
                        'title'       => $data['title'],
                        'sub_title'   => $data['sub_title'] ?? null,
                        'url'         => $data['url'] ?? null,
                        'description' => $data['description'] ?? null,
                    ]
                );
            }
        }

        // Thumb
        if ($request->hasFile('thumb')) {
            if ($event->thumb) {
                Storage::disk('public')->delete($event->thumb->image_path);
                $event->thumb()->delete();
            }
            storeImage($event, $request->thumb, 'events/thumbs', 'thumb', 'en', true);
        }

        // Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $img) {
                storeImage($event, $img, 'events/gallery', 'gallery');
            }
        }

        return redirect()->route('events.index')->with('success', 'Event saved successfully');
    }

    // Delete
    public function delete($id)
    {
        $event = Event::findOrFail($id);

        foreach ($event->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event deleted');
    }
}
