<?php

namespace Modules\DepartmentSlider\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class DepartmentSlider extends Model
{
    use Translatable;
    protected $table='department_sliders';
    protected $fillable = ['dept_id','slider','status'];
    public $translatedAttributes =  ['desc','title'];
    public function getSliderAttribute($value)
    {
        if ($value) {
            return asset('uploads/department_sliders/'.$value);
        } else {
            return asset('uploads/department_sliders/default.png');
        }
    }

    public function setSliderAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/department_sliders/'),$imageName);
            $this->attributes['slider']=$imageName;
        }
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department','dept_id');
    }
}
