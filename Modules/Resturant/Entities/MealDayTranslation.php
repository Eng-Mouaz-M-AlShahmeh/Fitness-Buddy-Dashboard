<?php

namespace Modules\Resturant\Entities;

use Illuminate\Database\Eloquent\Model;

class MealDayTranslation extends Model
{
    protected $table='meal_day_trans';
    protected $fillable = ['name','currency'];
    protected $primaryKey = 'meal_day_trans_id';
    public $timestamps = false;
}
