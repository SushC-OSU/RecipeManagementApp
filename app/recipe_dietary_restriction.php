<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recipe;
use App\dietaryrestriction;

class recipe_dietary_restriction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'dietary_restriction_id',
    ];

    public function recipes()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function dietaryRestriction()
    {
        return $this->belongsTo(dietaryrestriction::class);
    }
}
