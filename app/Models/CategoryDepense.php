<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryDepense extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'scolary_year_id', 'school_id'];

    /**
     * Get all of the depenses for the CategoryDepense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function depenses(): HasMany
    {
        return $this->hasMany(Depense::class);
    }
}
