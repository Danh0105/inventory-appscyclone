<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelofManuf extends Model
{
    use HasFactory;
    protected $table = 'models';
    protected $fillable = [
        'id',
        'model_name',
        'manufaturer_model_id'
    ];
    public function manufaturer(): BelongsTo
    {
        return $this->belongsTo(ManufaturerModel::class, 'manufaturer_model_id', 'id');
    }
}
