<?php

namespace Modules\Resturant\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class MealDay extends Model
{
    use Translatable;
    protected $table='meal_day';
    protected $fillable = ['price','number'];
    public $translatedAttributes =  ['name','currency'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
