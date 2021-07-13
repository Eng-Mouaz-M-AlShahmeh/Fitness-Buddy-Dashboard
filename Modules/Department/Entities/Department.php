<?php

namespace Modules\Department\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Translatable;
    protected $table='departments';
    protected $fillable = ['image','status'];
    public $translatedAttributes =  ['name','title'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('uploads/departments/'.$value);
        } else {
            return asset('uploads/departments/default.png');
        }
    }

    public function setImageAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/departments/'),$imageName);
            $this->attributes['image']=$imageName;
        }
    }
}
