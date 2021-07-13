<?php

namespace Modules\Resturant\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Resturant extends Model
{
    use Translatable;
    protected $table='resturants';
    protected $fillable = [
        'plan_id','city_id','price_delivery','icon','image',
        'lat','lng','closed','status','min','mins','type'
    ];
    public $translatedAttributes =  ['name','offer','min','price','terms'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/resturants/images/'.$value);
        } else {
            return asset('uploads/resturants/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/resturants/images/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }

    public function getIconAttribute($value)
    {
        if ($value) {
            return asset('uploads/resturants/icons/'.$value);
        } else {
            return asset('uploads/resturants/default.png');
        }
    }

    public function setIconAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/resturants/icons/'),$imageName);
            $this->attributes['icon']=$imageName;
        }
    }

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department','dept_id');
    }

    public function plan()
    {
        return $this->belongsTo('Modules\Plan\Entities\Plan','plan_id');
    }

    public function city()
    {
        return $this->belongsTo('Modules\City\Entities\City','city_id');
    }

    public function meals()
    {
        return $this->hasMany('Modules\Meal\Entities\Meal');
    }

}
