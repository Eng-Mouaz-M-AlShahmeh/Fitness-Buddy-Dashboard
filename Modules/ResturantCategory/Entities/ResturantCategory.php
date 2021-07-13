<?php

namespace Modules\ResturantCategory\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Resturant\Entities\MealDay;

class ResturantCategory extends Model
{
    use Translatable;
    protected $table='resturant_categories';
    protected $fillable = ['resturant_id','status','meal_day_id'];
    public $translatedAttributes =  ['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function resturant()
    {
        return $this->belongsTo('Modules\Resturant\Entities\Resturant','resturant_id');
    }

    public function mealsDay()
    {
        return $this->belongsTo('Modules\Resturant\Entities\MealDay','meal_day_id');
    }
}
