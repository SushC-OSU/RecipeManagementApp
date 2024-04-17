<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\recipe_dietary_restriction;

class dietaryrestriction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dietary_restriction_name', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function recipe_dietary_restriction()
    {
        return $this->hasMany(recipe_dietary_restriction::class);
    }
}
