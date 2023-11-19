<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'user_id',
        'department_id',
        'job_id',
        'gender',
        'email',
        'address',
        'phone_number',
        'photo'
    ];

    public function Department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    
    public function Job():BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    public function user():HasOne
    {
        return $this->hasOne(User::class);
    }

    public function loan(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
