<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssetReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_code',
        'loan_id',
        'return_date',
        'condition',
        'notes',
        'photo_receipt',
        'signature_admin',
        'signature_employee'
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
