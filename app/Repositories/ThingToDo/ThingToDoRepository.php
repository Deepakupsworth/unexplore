<?php

namespace App\Repositories\ThingToDo;

use App\Models\ThingToDo;
use App\Models\ThingToDoTranslation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Enums\CategoryType;
use App\Models\ThingToDoCategory;

class ThingToDoRepository implements ThingToDoRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        $request = request();

        $query = ThingToDo::with([
            'translations',
            'city.translations',
            'category.translations',
            'thingCategories.category.translation',
            'gallery'
        ]);

        // 🔍 Search by English name
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

        $citiesIds = $request->input('cities_ids');

        if (is_array($citiesIds) && count($citiesIds) > 0) {
            $query->whereIn('city_id', $citiesIds);
        }


        // 🗂 Category filter
        if ($request->filled('category_ids')) {
            $query->where('category_id', $request->category_id);
        }

        // 📍 Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        return $query->latest()
            ->paginate($perPage)
            ->withQueryString();
    }


    public function find(int $id): ?ThingToDo
    {
        return ThingToDo::with([
            'translations',
            'gallery',
            'thingCategories.category.translation',
            'tags'
        ])->find($id);
    }


    // public function createOrUpdate(array $data, ?int $id = null): ThingToDo
    // {
    //     return DB::transaction(function () use ($data, $id) {

    //         $translations = $data['translations'];
    //         $englishName  = $translations['en']['name'];

    //         /* ===================== MAIN ===================== */
    //         $thing = ThingToDo::updateOrCreate(
    //             ['id' => $id],
    //             [
    //                 'slug'        => $data['slug'] ?: Str::slug($englishName),
    //                 'city_id'     => $data['city_id'],
    //                 'category_id' => $data['category_id'] ?? null,
    //                 'location'    => $data['location'] ?? null,
    //                 'opening_time' => $data['opening_time'] ?? null,
    //                 'closing_time' => $data['closing_time'] ?? null,
    //                 'latitude'    => $data['latitude'] ?? null,
    //                 'longitude'   => $data['longitude'] ?? null,
    //             ]
    //         );

    //         /* ===================== THUMB ===================== */
    //         if (!empty($data['thumb_image'])) {
    //             storeImage(
    //                 model: $thing,
    //                 file: $data['thumb_image'],
    //                 folder: 'thingtodos/thumbs',
    //                 role: 'thumb'
    //             );
    //         }

    //         /* ===================== TRANSLATIONS ===================== */
    //         foreach ($translations as $lang => $fields) {
    //             $lang = strtolower($lang);
    //             $name = trim($fields['name'] ?? '');
    //             $about = trim($fields['about'] ?? '');

    //             if ($name === '') {
    //                 ThingToDoTranslation::where('thing_id', $thing->id)
    //                     ->where('language_code', $lang)
    //                     ->delete();
    //                 continue;
    //             }

    //             ThingToDoTranslation::updateOrCreate(
    //                 [
    //                     'thing_id'      => $thing->id,
    //                     'language_code' => $lang,
    //                 ],
    //                 [
    //                     'name'  => $name,
    //                     'about' => $about,
    //                 ]
    //             );
    //         }

    //         /* ===================== GALLERY ===================== */

    //         /* ===================== GALLERY ===================== */
    //         if (!empty($data['gallery']) && is_array($data['gallery'])) {
    //             foreach ($data['gallery'] as $file) {
    //                 storeImage($thing, $file, 'thingtodos/gallery', 'gallery');
    //             }
    //         }


    //         return $thing;
    //     });
    // }

    public function createOrUpdate(array $data, ?int $id = null): ThingToDo
    {
        return DB::transaction(function () use ($data, $id) {

            $translations = $data['translations'];
            $englishName  = $translations['en']['name'];

            /* ===================== MAIN ===================== */
            $thing = ThingToDo::updateOrCreate(
                ['id' => $id],
                [
                    'slug'         => $data['slug'] ?: Str::slug($englishName),
                    'city_id'      => $data['city_id'],
                    'location'     => $data['location'] ?? null,
                    'opening_time' => $data['opening_time'] ?? null,
                    'closing_time' => $data['closing_time'] ?? null,
                    'latitude'     => $data['latitude'] ?? null,
                    'longitude'    => $data['longitude'] ?? null,
                    'video_url'    => $data['video_url'] ?? null
                ]
            );

            /* ===================== MULTI CATEGORY (PIVOT) ===================== */
            if (!empty($data['category_ids']) && is_array($data['category_ids'])) {

                // remove old relations
                ThingToDoCategory::where('thing_id', $thing->id)->delete();

                // insert new relations
                foreach ($data['category_ids'] as $categoryId) {
                    ThingToDoCategory::create([
                        'thing_id'    => $thing->id,
                        'category_id' => $categoryId,
                    ]);
                }
            }

              /* ===================== TAGS (SAVE + UPDATE) ===================== */
            if (!empty($data['tags']) && is_array($data['tags'])) {
                $thing->tags()->sync($data['tags']);   // create / update
            } else {
                $thing->tags()->detach();              // remove all
            }

            /* ===================== THUMB ===================== */
            if (!empty($data['thumb_image'])) {
                storeImage(
                    model: $thing,
                    file: $data['thumb_image'],
                    folder: 'thingtodos/thumbs',
                    role: 'thumb'
                );
            }

            /* ===================== TRANSLATIONS ===================== */
            foreach ($translations as $lang => $fields) {
                $lang  = strtolower($lang);
                $name  = trim($fields['name'] ?? '');
                $about = trim($fields['about'] ?? '');

                if ($name === '') {
                    ThingToDoTranslation::where('thing_id', $thing->id)
                        ->where('language_code', $lang)
                        ->delete();
                    continue;
                }

                ThingToDoTranslation::updateOrCreate(
                    [
                        'thing_id'      => $thing->id,
                        'language_code' => $lang,
                    ],
                    [
                        'name'  => $name,
                        'about' => $about,
                    ]
                );
            }

            /* ===================== GALLERY ===================== */
            if (!empty($data['gallery']) && is_array($data['gallery'])) {
                foreach ($data['gallery'] as $file) {
                    storeImage($thing, $file, 'thingtodos/gallery', 'gallery');
                }
            }

            return $thing;
        });
    }


    public function delete(int $id): bool
    {
        $thing = ThingToDo::findOrFail($id);

        // Deletes images automatically via images() cascade
        return $thing->delete();
    }
}
