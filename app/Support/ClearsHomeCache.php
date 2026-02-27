<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;
use App\Models\Language;

trait ClearsHomeCache
{
    protected function clearPackagePageCache(): void
    {
        Language::pluck('code')
            ->each(function ($lang) {

                $keys = [
                    "home_page_data_{$lang}",
                    "header_packages_{$lang}",
                 
                ];

                foreach ($keys as $key) {
                    Cache::forget($key); // safe if key not found
                }
            });
    }

    protected function clearEventPageCache(): void
    {
        Language::pluck('code')
            ->each(function ($lang) {

                $keys = [
                    "home_page_data_{$lang}",
                    "header_event_categories_{$lang}",
                   
                ];

                foreach ($keys as $key) {
                    Cache::forget($key); // safe if key not found
                }
            });
    }

    protected function clearTodoPageCache(): void
    {
        Language::pluck('code')
            ->each(function ($lang) {

                $keys = [
                    "home_page_data_{$lang}",
                    "header_todos_{$lang}",
                    
                ];

                foreach ($keys as $key) {
                    Cache::forget($key); // safe if key not found
                }
            });
    }

    protected function clearDestinationPageCache(): void
    {
        Language::pluck('code')
            ->each(function ($lang) {

                $keys = [
                    "home_page_data_{$lang}",
                    "header_destination_categories_{$lang}",
                    "frontend_destinations_{$lang}"
                ];

                foreach ($keys as $key) {
                    Cache::forget($key); // safe if key not found
                }
            });
    }
}