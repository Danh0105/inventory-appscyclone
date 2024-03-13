<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'asset_name',
        'category',
        'condition',
        'note',
        'date',
        'serial',
        'modelof_manuf_id',
        'supplier_model_id',
        'location_model_id',
        'warranty',
        'price'
    ];
    public function modelof_mannuf(): BelongsTo
    {
        return $this->belongsTo(ModelofManuf::class, 'modelof_manuf_id', 'id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_model_id', 'id');
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(LocationModel::class, 'location_model_id', 'id');
    }
    public function image(): HasMany
    {
        return $this->hasMany(ImageModel::class, 'asset_model_id', 'id');
    }
}
