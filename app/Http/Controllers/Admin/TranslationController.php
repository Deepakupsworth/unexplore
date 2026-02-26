<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class TranslationController extends Controller
{
    protected array $locales = ['en', 'de', 'fr'];

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
    public function updateOne(Request $request)
    {
        $this->save($request->group, [$request->key => $request->values]);
        return back()->with('success', 'Updated');
    }

    /* =====================================================
       UPDATE ALL
    ===================================================== */
    public function updateAll(Request $request)
    {
        $this->save($request->group, $request->data);
        return back()->with('success', 'All updated');
    }

    /* =====================================================
       FILE SAVE HANDLER
    ===================================================== */
    protected function save($group, $data)
    {
        foreach ($this->locales as $locale) {

            if ($group === 'common') {
                $file = resource_path("lang/{$locale}.json");
                $content = file_exists($file)
                    ? json_decode(file_get_contents($file), true)
                    : [];
            } else {
                $file = resource_path("lang/{$locale}/{$group}.php");
                $content = file_exists($file) ? include $file : [];
            }

            foreach ($data as $key => $values) {
                $content[$key] = $values[$locale] ?? '';
            }

            if ($group === 'common') {
                file_put_contents(
                    $file,
                    json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
                );
            } else {
                file_put_contents(
                    $file,
                    "<?php\n\nreturn " . var_export($content, true) . ";\n"
                );
            }
        }

        Artisan::call('cache:clear');
    }
}