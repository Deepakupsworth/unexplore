<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use App\Models\TransportTranslation;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::with([
            'translations' => fn($q) => $q->where('language_code', 'en'),
            'city',
            'thumb'
        ])->paginate(10);

        return view('backend.transports.index', compact('transports'));
    }

    public function form($id = null)
    {
        $model = Transport::with(['translations', 'gallery', 'thumb'])->find($id) ?? new Transport();
        $cities = City::pluck('slug', 'id');
        $languages = Language::all();

        return view('backend.transports.form', compact('model', 'cities', 'languages'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'type' => 'required',
            'translations.en.name' => 'required'
        ]);

        $transport = Transport::updateOrCreate(
            ['id' => $request->id],
            [
                'city_id' => $request->city_id,
                'type' => $request->type,
                'capacity' => $request->capacity,
                'contact_number' => $request->contact_number,
                'status' => $request->status ?? 1,
            ]
        );

        // Save translations
        foreach ($request->translations as $lang => $data) {
            $lang = strtolower($lang);
            if (!empty($data['name'])) {
                TransportTranslation::updateOrCreate(
                    [
                        'transport_id' => $transport->id,
                        'language_code' => $lang
                    ],
                    [
                        'name' => $data['name'],
                        'message' => $data['message'] ?? null
                    ]
                );
            }
        }

        // Thumb
        if ($request->hasFile('thumb')) {
            if ($transport->thumb) {
                Storage::disk('public')->delete($transport->thumb->image_path);
                $transport->thumb()->delete();
            }
            storeImage($transport, $request->thumb, 'transports/thumbs', 'thumb', 'en', true);
        }

        // Gallery
        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $img) {
                storeImage($transport, $img, 'transports/gallery', 'gallery');
            }
        }

        return redirect()->route('transports.index')->with('success', 'Transport saved');
    }

    public function delete($id)
    {
        $transport = Transport::findOrFail($id);
        foreach ($transport->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        $transport->delete();

        return back()->with('success', 'Transport deleted');
    }
}
