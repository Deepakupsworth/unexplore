<?php

namespace App\Imports;

use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountriesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Country([
            'name'          => $row['name'],
            'code'          => strtoupper($row['code']),
            'currency_code' => strtoupper($row['currency_code']),
            'status'        => isset($row['status']) ? $row['status'] : 1,
        ]);
    }
}
