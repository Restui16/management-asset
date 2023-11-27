<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Loan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'loan_code',
        'employee_id',
        'loan_date',
        'return_date',
        'photo_receipt',
        'pic',
        'signature_employee',
        'signature_admin',
        'notes'
    ];

    public function asset():BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'asset_loans');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function assetreturn(): HasOne
    {
        return $this->HasOne(AssetReturn::class);
    }

    public function assetloan(): HasMany
    {
        return $this->hasMany(AssetLoan::class);
    }
}
