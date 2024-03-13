<?php

namespace App\Imports;

use App\Models\Admin\LocationModel;
use Maatwebsite\Excel\Concerns\ToModel;


class LocationImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new LocationModel([
            'department_model_id' => $row[0],
            'location_name' => $row[1],
            'note' => $row[2],
        ]);
    }
}
