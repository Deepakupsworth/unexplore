<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\Interfaces\PackageRepositoryInterface;

class PackageRepository extends BaseRepository implements PackageRepositoryInterface
{
    public function __construct(Package $package)
    {
        $this->model = $package;
    }

    public function findWithRelations(int $id): Package
    {
        return $this->model->with([
            'translations',
            'availabilities',
            'cities',
            'days.items',
            'prices.childPrices',
            'prices.increasePersons',
            'infos.translations',
        ])->findOrFail($id);
    }
}
