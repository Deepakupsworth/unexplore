<?php
namespace App\Services\Package;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Enums\PackageStatus;
use App\Enums\PackageType;

class PackageService
{
    public function __construct(
        protected PackageRepositoryInterface $repo
    ) {}

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $package = $this->repo->create([
                'slug'            => $data['slug'],
                'status'          => PackageStatus::DRAFT,
                'package_type'    => PackageType::FIXED,
                'category_id'     => $data['category_id'],
                'duration_days'   => $data['duration_days'],
                'duration_nights' => $data['duration_nights'],
                'base_persons'    => $data['base_persons'],
                'max_persons'     => $data['max_persons'],
            ]);

            // translations
            foreach ($data['translations'] as $lang => $t) {
                $package->translations()->create([
                    'language_code' => $lang,
                    'title'         => $t['title'],
                    'sub_title'     => $t['sub_title'] ?? null,
                    'description'   => $t['description'] ?? null,
                ]);
            }

            return $package;
        });
    }
}
