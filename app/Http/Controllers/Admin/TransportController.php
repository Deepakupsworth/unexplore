<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use App\Models\TransportTranslation;
use App\Models\City;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\TransportType;
class TransportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transport::query()
            ->with([
                'translations' => fn($q) => $q->where('language_code', 'en'),
                'city',
                'thumb'
            ]);

        // 🔍 Search by name
        if ($request->filled('search')) {
            $query->whereHas('translations', function ($q) use ($request) {
                $q->where('language_code', 'en')
                    ->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // 🏙 City filter
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // 🚗 Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 🟢 Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transports = $query->latest()->paginate(10)->withQueryString();

        $cities = City::pluck('slug', 'id');

        return view('backend.transports.index', compact('transports', 'cities'));
    }


    public function form($id = null)
    {
        $model = Transport::with(['translations', 'gallery', 'thumb'])
            ->find($id) ?? new Transport();

        $cities = City::pluck('slug', 'id');
        $languages = Language::all();
        $types = TransportType::cases();   // ✅ Enum values
        return view('backend.transports.form', compact(
            'model',
            'cities',
            'languages',
            'types'
        ));
    }

    public function show($id)
    {
        $transport = Transport::with([
            'translations',
            'city',
            'images',
            'thumb'
        ])->findOrFail($id);

        return view('backend.transports.show', compact('transport'));
    }


    public function save(Request $request)
    {
        dd($request->all());
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
                        'description' => $data['description'] ?? null
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
