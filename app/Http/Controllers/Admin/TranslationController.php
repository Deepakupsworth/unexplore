<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class TranslationController extends Controller
{
    protected array $locales = ['en', 'de'];

    /* =====================================================
       INDEX: show group list + common
    ===================================================== */
    public function index()
    {
        // common (json)
        $groups = ['common'];

        // scan group files from lang/en
        $path = resource_path('lang/en');
        if (is_dir($path)) {
            foreach (scandir($path) as $file) {
                if (str_ends_with($file, '.php')) {
                    $groups[] = str_replace('.php', '', $file);
                }
            }
        }

        return view('backend.translations.index', compact('groups'));
    }

    /* =====================================================
       EDIT: list keys + values
    ===================================================== */
    public function edit($group)
    {
        $data = [];

        foreach ($this->locales as $locale) {
            if ($group === 'common') {
                $file = resource_path("lang/{$locale}.json");
                $data[$locale] = file_exists($file)
                    ? json_decode(file_get_contents($file), true)
                    : [];
            } else {
                $file = resource_path("lang/{$locale}/{$group}.php");
                $data[$locale] = file_exists($file) ? include $file : [];
            }
        }

        // collect all keys
        $keys = collect($data)->collapse()->keys()->unique();

        $rows = [];
        foreach ($keys as $key) {
            foreach ($this->locales as $locale) {
                $rows[$key][$locale] = $data[$locale][$key] ?? '';
            }
        }

        return view('backend.translations.edit', compact('rows', 'group'));
    }

    /* =====================================================
       UPDATE ONE KEY
    ===================================================== */
    public function updateOne1(Request $request, $group)
    {

        //print_r($request->all());die;

        $key = $request->key;
        $values = $request->translations; // [en => val, de => val]

        foreach ($this->locales as $locale) {

            /* ===== COMMON (JSON) ===== */
            if ($group === 'common') {

                $file = resource_path("lang/{$locale}.json");
                $data = file_exists($file)
                    ? json_decode(file_get_contents($file), true)
                    : [];

                $data[$key] = $values[$locale] ?? '';

                file_put_contents(
                    $file,
                    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
            }

            /* ===== GROUP (PHP) ===== */
            else {

                $dir = resource_path("lang/{$locale}");
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                $file = "{$dir}/{$group}.php";
                $data = file_exists($file) ? include $file : [];

                $data[$key] = $values[$locale] ?? '';

                file_put_contents(
                    $file,
                    "<?php\n\nreturn " . var_export($data, true) . ";\n"
                );
            }
        }

        return back()->with('success', 'Translation updated');
    }

    /* =====================================================
       UPDATE ALL KEYS
    ===================================================== */
    public function updateAll1(Request $request, $group)
    {
        //print_r($request->all());die;
        $translations = $request->translations; // [key => [locale => value]]

        foreach ($this->locales as $locale) {

            /* ===== COMMON (JSON) ===== */
            if ($group === 'common') {

                $file = resource_path("lang/{$locale}.json");
                $data = file_exists($file)
                    ? json_decode(file_get_contents($file), true)
                    : [];

                foreach ($translations as $key => $langs) {
                    $data[$key] = $langs[$locale] ?? '';
                }

                file_put_contents(
                    $file,
                    json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
            }

            /* ===== GROUP (PHP) ===== */
            else {

                $dir = resource_path("lang/{$locale}");
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                $file = "{$dir}/{$group}.php";
                $data = file_exists($file) ? include $file : [];

                foreach ($translations as $key => $langs) {
                    $data[$key] = $langs[$locale] ?? '';
                }

                file_put_contents(
                    $file,
                    "<?php\n\nreturn " . var_export($data, true) . ";\n"
                );
            }
        }

        return back()->with('success', 'All translations updated');
    }

    /* =====================================================
       FILE SAVE HANDLER
    ===================================================== */

    public function updateOne(Request $request, $group)
    {
        $key = $request->key;
        $translations = $request->translations[$key] ?? []; // this now gets the correct values

        $this->save($group, [
            $key => $translations
        ]);

        return back()->with('success', 'Updated successfully');
    }

    // UPDATE ALL KEYS
    public function updateAll(Request $request, $group)
    {
        $translations = $request->translations ?? []; // [key => [locale => value]]
        $this->save($group, $translations);

        return back()->with('success', 'All translations updated');
    }

    protected function saveOld(string $group, array $data): void
    {
        foreach ($this->locales as $locale) {

            if ($group === 'common') {
                $file = resource_path("lang/{$locale}.json");

                // Load existing translations or empty array
                $existing = file_exists($file)
                    ? json_decode(file_get_contents($file), true)
                    : [];

                foreach ($data as $key => $translations) {
                    // Only overwrite the value for this locale, keep other locales intact
                    if (isset($translations[$locale])) {
                        $existing[$key] = $translations[$locale];
                    }
                }

                file_put_contents(
                    $file,
                    json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
            } else {
                $dir = resource_path("lang/{$locale}");
                if (!is_dir($dir)) mkdir($dir, 0755, true);

                $file = "{$dir}/{$group}.php";

                // Load existing translations or empty array
                $existing = file_exists($file) ? include $file : [];

                foreach ($data as $key => $translations) {
                    if (isset($translations[$locale])) {
                        $existing[$key] = $translations[$locale];
                    }
                }

                file_put_contents(
                    $file,
                    "<?php\n\nreturn " . var_export($existing, true) . ";\n"
                );
            }
        }
    }

    protected function save(string $group, array $data): void
{
    // 1️⃣ Collect all keys from submitted data
    $allKeys = array_keys($data);

    foreach ($this->locales as $locale) {

        if ($group === 'common') {
            $file = resource_path("lang/{$locale}.json");

            // Load existing translations or empty array
            $existing = file_exists($file)
                ? json_decode(file_get_contents($file), true)
                : [];

            foreach ($allKeys as $key) {
                // If value submitted for this locale, use it; else keep existing; else empty
                $existing[$key] = $data[$key][$locale] ?? ($existing[$key] ?? '');
            }

            file_put_contents(
                $file,
                json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

        } else {
            $dir = resource_path("lang/{$locale}");
            if (!is_dir($dir)) mkdir($dir, 0755, true);

            $file = "{$dir}/{$group}.php";

            // Load existing translations or empty array
            $existing = file_exists($file) ? include $file : [];

            foreach ($allKeys as $key) {
                $existing[$key] = $data[$key][$locale] ?? ($existing[$key] ?? '');
            }

            file_put_contents(
                $file,
                "<?php\n\nreturn " . var_export($existing, true) . ";\n"
            );
        }
    }
}
}