<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maatwebsite\Excel\Concerns\ToModel;

class LocationModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'department_model_id',
        'location_name',
        'note',
    ];
    public function department(): BelongsTo
    {
        return $this->belongsTo(DepartmentModel::class, 'department_model_id', 'id');
    }
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'location_model_id', 'id');
    }
}
