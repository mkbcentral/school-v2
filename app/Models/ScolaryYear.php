<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScolaryYear extends Model
{
    use HasFactory;
    protected $fillable=['name','school_id','active','school_id'];

    /**
     * Get the school that owns the ScolaryYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    /**
     * Get all of the students for the ScolaryYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all of the inscrptions for the ScolaryYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscrptions(): HasMany
    {
        return $this->hasMany(Inscription::class);
    }

    /**
     * Get all of the paiments for the ScolaryYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paiments(): HasMany
    {
        return $this->hasMany(Paiment::class);
    }
}
