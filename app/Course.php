<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_name', 'is_active',
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

    public function recipes()
    {
        return $this->hasOne(Recipe::class);
    }
}
