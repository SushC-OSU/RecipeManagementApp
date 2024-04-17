<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\cuisine;
use App\Course;
use App\recipe_dietary_restriction;

class recipe extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_name', 'ingredients', 'cooking_time', 'serving_size', 'description','cuisine_id','course_id',
    ];

    public function cuisine()
    {
        return $this->belongsTo(cuisine::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }

    public function recipe_dietary_restriction()
    {
        return $this->hasMany(recipe_dietary_restriction::class);
    }
    

}
