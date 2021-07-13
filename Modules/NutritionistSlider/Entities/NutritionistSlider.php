<?php

namespace Modules\NutritionistSlider\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NutritionistSlider extends Model
{
    use Translatable;
    protected $table = 'nutritionist_sliders';
    protected $fillable = ['nutritionist_id','image','status'];
    public $translatedAttributes =  ['title','description'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/department_sliders/'.$value);
        } else {
            return asset('uploads/department_sliders/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/department_sliders/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

    public function nutritionist()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist','nutritionist_id');
    }
}
