<?php

namespace Modules\Meal\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Plan\Entities\Plan;

class Meal extends Model
{
    use Translatable;
    protected $table='meals';
    protected $fillable = [
        'resturant_id','cat_id','meal_id','image',
        'calories','price_before','branch_id',
        'price_after','meal_day_id','day_id','plan_id'];
    public $translatedAttributes =  ['name','desc','currency','calorie'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/meals/'.$value);
        } else {
            return asset('uploads/meals/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/meals/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

    public function resturant()
    {
        return $this->belongsTo('Modules\Resturant\Entities\Resturant','resturant_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('Modules\ResturantCategory\Entities\ResturantCategory','cat_id');
    }
    public function mealday(){
        return $this->belongsTo('Modules\Resturant\Entities\MealDay','meal_day_id');
    }
    public function day(){
        return $this->belongsTo('App\Models\Day','day_id');
    }
    public function branch()
    {
        return $this->belongsTo('Modules\Branch\Entities\Branch','branch_id', 'id');
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id', 'id');
    }
}
