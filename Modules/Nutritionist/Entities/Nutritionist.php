<?php

namespace Modules\Nutritionist\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Nutritionist extends Model
{
    use Translatable;
    protected $table='nutritionist';
    protected $fillable = [
        'dept_id','plan_id','type',
        'city_id','price','image','status','lat','lng',
        'nationality_id','age','available_time','is_busy'
    ];
    public $translatedAttributes =  ['name','about','level','currency','terms'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/nutritionist/images/'.$value);
        } else {
            return asset('uploads/nutritionist/images/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/nutritionist/images/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
    public function plan()
    {
        return $this->belongsTo('Modules\Plan\Entities\Plan','plan_id');
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department','dept_id');
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
