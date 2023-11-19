<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function Asset(): HasMany
    {
        return $this->hasMany(Asset::class);
    }
}
