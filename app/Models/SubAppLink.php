<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubAppLink extends Model
{
    use HasFactory;

    protected $fillable=['name','icon','link','color'];

     /**
     * The users that belong to the AppLink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'sub_app_link_user', 'user_id', 'sub_app_link_id');
    }
}
