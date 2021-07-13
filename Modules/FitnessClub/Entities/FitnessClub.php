<?php

namespace Modules\FitnessClub\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class FitnessClub extends Model
{
    use Translatable;
    protected $table='fitness_clubs';
    protected $fillable = [
        'dept_id', 'lat','lng', 'logo','image','status','city_id','type'
    ];

    public $translatedAttributes = ['name','desc','terms'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/clubs/images/'.$value);
        } else {
            return asset('uploads/clubs/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/clubs/images/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }


    public function getLogoAttribute($value)
    {
        if ($value) {
            return asset('uploads/clubs/logos/'.$value);
        } else {
            return asset('uploads/clubs/logos/default.png');
        }
    }

    public function setLogoAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/clubs/logos/'),$imageName);
            $this->attributes['logo']=$imageName;
        }
    }
    public function city()
    {
        return $this->belongsTo('Modules\City\Entities\City','city_id');
    }
}
