<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'department_name',
        'floor',
        'unit',
        'building',
        'street_address',
        'city_name',
        'state_name',
        'country',
        'zip_code',
    ];
    public function location(): HasMany
    {
        return $this->hasMany(LocationModel::class, 'department_model_id', 'id');
    }
}
