<?php

namespace Modules\Trainer\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TrainerSlider extends Model
{
    use Translatable;
    protected $table = 'trainer_sliders';
    protected $fillable = ['trainer_id','image','status'];
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

    public function trainer()
    {
        return $this->belongsTo('Modules\Trainer\Entities\Trainer','trainer_id');
    }
}
