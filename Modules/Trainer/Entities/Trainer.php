<?php

namespace Modules\Trainer\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use Translatable;
    protected $table='trainers';
    protected $fillable = ['dept_id','plan_id','type','city_id',
        'price','image','status','nationality_id',
        'age','available_time','lat','lng','is_busy'];
    public $translatedAttributes =  ['name','about','level','currency','terms'];
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/trainers/images/'.$value);
        } else {
            return asset('uploads/trainers/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/trainers/images/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

    public function plan()
    {
        return $this->belongsTo('Modules\Plan\Entities\Plan','plan_id');
    }


    public function city()
    {
        return $this->belongsTo('Modules\City\Entities\City','city_id');
    }
    public function nationality()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Nationality','nationality_id');
    }
}
