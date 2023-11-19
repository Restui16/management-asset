<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
    ];

    public function Employee(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
