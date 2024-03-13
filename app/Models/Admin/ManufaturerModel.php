<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManufaturerModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'manuf_name',
    ];
    public function modelofManuf(): HasMany
    {
        return $this->hasMany(ModelofManuf::class);
    }
}
