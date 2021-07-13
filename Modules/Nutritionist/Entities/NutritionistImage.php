<?php

namespace Modules\Nutritionist\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NutritionistImage extends Model
{
    use Translatable;
    protected $table='nutritionist_images';
    protected $fillable = ['nutritionist_id','image','status'];
    protected $translatedAttributes=['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

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
            $videoName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/nutritionist/images/'),$videoName);
            $this->attributes['image']=$videoName;
        }
    }
    public function nutritionist()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist','nutritionist_id');
    }
}
