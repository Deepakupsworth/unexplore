<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventGalleryImage;
use App\Models\EventTranslation;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Show all events list
     */
    public function index()
    {
        $events = Event::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->paginate(10); 

        // print_r($events); die;
        return view('backend.events.index', compact('events'));
    }

    public function form($id = null)
    {
        $model = Event::with(['translations', 'galleryImages'])->find($id) ?? new Event();
        $languages = Language::all();

        // fetch all cities with plucked id and name in english
        $cities = \App\Models\City::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->get()->pluck('translations.0.name', 'id'); 

        $categories = \App\Models\Category::with(['translations' => function($q){
            $q->whereHas('language', fn($l) => $l->where('code', 'en'));
        }])->get()->pluck('translations.0.name', 'id'); 


        // print_r($cities); die;
        return view('backend.events.form', compact('model', 'languages', 'cities', 'categories'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'translations.*.name' => 'nullable|string|max:255',
            'translations.1.name' => 'required|string|max:255', // English required (id=1)
        ]);

        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
//   print_r($request->all()); die;
        $events = Event::updateOrCreate(
            ['id' => $request->id],
            [
                'slug' => $request->slug ?? Str::slug($request->translations[1]['name']),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'opening_days' => $request->opening_days,
                'city_id' => $request->city_id,
            ]
        );


        if ($request->hasFile('thumb_image')) {
            if ($events->thumb_image) {
                Storage::delete('public/' . $events->thumb_image);
            }
            $path = $request->file('thumb_image')->store('events/thumbs', 'public');
            $events->update(['image' => $path]); 
        }

        // Save translations
        foreach ($request->translations as $langId => $data) {
            if($data['name']){
                EventTranslation::updateOrCreate(
                    ['event_id' => $events->id, 'language_id' => $langId],
                    [
                        'name' => $data['name'] ?? '',
                        'about' => $data['about'] ?? '',
                    ]
                );
            }
        }

       // Save gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('event/gallery', 'public');
                EventGalleryImage::create([
                    'event_id' => $events->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('events.index')->with('success', 'Event saved successfully!');
    }

    public function deleteGalleryImage($id)
    {
        $image = EventGalleryImage::findOrFail($id);
        if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        $event->delete();
        return redirect()->back()->with('success', 'Event deleted successfully.');
    } 
}
