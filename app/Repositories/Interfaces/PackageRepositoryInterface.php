<?php

namespace App\Repositories\Interfaces;

use App\Models\Package;

interface PackageRepositoryInterface
{
    public function create(array $data): Package;

    public function findWithRelations(int $id): Package;
}
