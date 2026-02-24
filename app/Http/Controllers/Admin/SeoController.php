<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Helpers\Seo\SeoHelper;
use App\Models\Currency;

class SeoController extends Controller
{
    protected array $models = [
        'package' => \App\Models\Package::class,
        'todo'    => \App\Models\ThingToDo::class,
        'event'   => \App\Models\Event::class,
        'city'    => \App\Models\City::class,
    ];

    private function resolveModel(string $type, int $id)
    {
        abort_unless(isset($this->models[$type]), 404);
        return $this->models[$type]::findOrFail($id);
    }

    public function edit(string $type, int $id)
    {
        $item = $this->resolveModel($type, $id);

        $languages = Language::all();
        $currencies = Currency::all();

        // SEO indexed by language_code
        $seoMetas = $item->seo
            ->keyBy('language_code');



    $defaultSeo = [];

    foreach ($languages as $lang)
    {

        $code = strtolower($lang->code);

        // get translation by language_code
        $translation = $item->translations
            ->where('language_code', $code)
            ->first();

        // if SEO already exists → skip defaults
        if ($seoMetas->has($code)) {
            continue;
        }

        $defaultSeo[$code] = [
            'meta_title' => $translation?->title ?? $translation?->name ?? '',
            'meta_description' => '',

            'schema' => match ($type) {

                'package' => [
                    '@type' => 'Product',
                    'name'  => $translation?->title ?? '',
                    'price' => $item->price ?? null,
                    'currency' => $item->currency?->code ?? null,
                ],

                'event' => [
                    '@type' => 'Event',
                    'name'  => $translation?->title ?? '',
                ],

                'todo' => [
                    '@type' => 'TouristAttraction',
                    'name'  => $translation?->name ?? '',
                ],

                'city' => [
                    '@type' => 'Place',
                    'name'  => $translation?->name ?? '',
                ],

                default => null,
            }
        ];
    }




    return view('backend.admin.seo.form', [
        'item'      => $item,
        'type'      => $type,
        'languages' => $languages,
        'currencies'=> $currencies,
        'seoMetas'  => $seoMetas,
        'defaultSeo' => $defaultSeo,
    ]);
    }


    public function update(Request $request, string $type, int $id)
    {
        $item = $this->resolveModel($type, $id);

        //print_r($request->all());die;

        foreach ($request->seo as $languageCode => $data) {

            \App\Helpers\SeoHelper::saveSeo(
                $item,
                $languageCode, // 👈 locale / language_code
                [
                    'meta_title'       => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'schema_json'      => !empty($data['schema'])
                        ? $data['schema']
                        : null,
                ]
            );
        }

        return redirect()->back()->with('success', 'SEO updated for all languages');
    }
}
