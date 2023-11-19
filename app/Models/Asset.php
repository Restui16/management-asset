<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_asset_id',
        'location_id',
        'name',
        'serial_number',
        'price',
        'purchase_date',
        'description',
        'condition',
        'status'
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function CategoryAsset(): BelongsTo
    {
        return $this->belongsTo(CategoryAsset::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function loan(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class, 'asset_loans');
    }

    public function assetLoan(): HasMany
    {
        return $this->HasMany(AssetLoan::class);
    }
}
