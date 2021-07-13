<?php

namespace Modules\MealIngredient\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class MealIngredient extends Model
{
    use Translatable;
    protected $table='meal_ingrediants';
    protected $fillable = ['meal_id','calorie'];
    public $translatedAttributes =  ['ingredient','calories'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function meal()
    {
        return $this->belongsTo('Modules\Meal\Entities\Meal','meal_id');
    }

}
