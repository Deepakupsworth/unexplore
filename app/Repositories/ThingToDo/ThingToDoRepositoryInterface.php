<?php

namespace App\Repositories\ThingToDo;

use App\Models\ThingToDo;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ThingToDoRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function find(int $id): ?ThingToDo;

    public function createOrUpdate(array $data, ?int $id = null): ThingToDo;

    public function delete(int $id): bool;
}
