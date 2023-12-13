<?php

namespace App\Models;

use App\Livewire\Helpers\DateFormatHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'date_of_birth',
        'place_of_birth',
        'scolary_year_id',
        'gender',
        'student_responsable_id',
        'school_id'];
    protected $casts = [
        'date_of_birth' => 'date:Y-m-d',
    ];
    public function getAge($date)
    {
        return (new DateFormatHelper())->getUserAge($date);
    }

    /**
     * Get the inscriotin that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inscription(): HasOne
    {
        return $this->hasOne(Inscription::class,);
    }

    /**
     * Get the user that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function studentResponsable(): BelongsTo
    {
        return $this->belongsTo(StudentResponsable::class, 'student_responsable_id');
    }

    /**
     * Get the ScolaryYear that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scolaryYear(): BelongsTo
    {
        return $this->belongsTo(ScolaryYear::class, 'scolary_year_id');
    }
}
