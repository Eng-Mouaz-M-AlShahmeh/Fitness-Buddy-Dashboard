<?php

namespace Modules\Trainer\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TrainerImage extends Model
{
    use Translatable;
    protected $table='trainer_images';
    protected $fillable = ['trainer_id','image','status'];
    protected $translatedAttributes=['name'];
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/trainers/traineresimages/'.$value);
        } else {
            return asset('uploads/trainers/traineresimages/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/trainers/traineresimages/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
    public function trainer()
    {
        return $this->belongsTo('Modules\Trainer\Entities\Trainer','trainer_id');
    }

}
