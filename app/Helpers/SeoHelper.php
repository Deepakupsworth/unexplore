<?php

namespace App\Helpers;

use App\Models\SeoMeta;
use App\Models\StaticPage;

use Illuminate\Database\Eloquent\Model;

class SeoHelper
{
    /**
     * Create or update SEO meta for any model (multi-language)
     */
    public static function saveSeo(
        Model $model,
        string $locale,
        array $data
    ): SeoMeta {
        return SeoMeta::updateOrCreate(
            [
                'metaable_id'   => $model->id,
                'metaable_type' => get_class($model),
                'language_code'        => $locale,
            ],
            [
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'schema_json'      => $data['schema_json'] ?? null,
            ]
        );
    }


    /**
     * Create or update SEO for a static page (multi-language)
     *
     * @param array $data [
     *      'slug' => 'about-us',
     *      'locale' => 'en',
     *      'page_title' => 'About Us',
     *      'meta_title' => 'About Us - MySite',
     *      'meta_description' => 'Description here...',
     *      'schema_json' => [...]
     * ]
     */
    public static function upsertSeoMetaStatic(array $data): StaticPage
    {
        return StaticPage::updateOrCreate(
            [
                'slug'   => $data['slug'],
                'locale' => $data['locale'],
            ],
            [
                'page_title'       => $data['page_title'],
                'meta_title'       => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'schema_json'      => $data['schema_json'] ?? null,
            ]
        );
    }

}
