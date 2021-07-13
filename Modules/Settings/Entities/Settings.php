<?php

namespace Modules\Settings\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use Translatable;
    protected $table = 'settings';
    protected $fillable = ['logo'];
    public $translatedAttributes =  ['about','privacy','name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getLogoAttribute($value)
    {
        if ($value) {
            return asset('uploads/settings/'.$value);
        } else {
            return asset('uploads/settings/default.png');
        }
    }

    public function setLogoAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/settings/'),$imageName);
            $this->attributes['logo']=$imageName;
        }
    }
}
