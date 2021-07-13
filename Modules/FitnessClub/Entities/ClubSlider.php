<?php

namespace Modules\FitnessClub\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClubSlider extends Model
{
    protected $table='club_sliders';
    protected $fillable = ['club_id','image','status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/clubs/sliders/'.$value);
        } else {
            return asset('uploads/clubs/sliders/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/clubs/sliders/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
    public function club()
    {
        return $this->belongsTo('Modules\FitnessClub\Entities\FitnessClub','club_id');
    }

}
