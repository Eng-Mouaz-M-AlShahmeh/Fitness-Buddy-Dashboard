<?php

namespace Modules\Nutritionist\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use Translatable;
    protected $table='languages';
    protected $fillable = ['status'];
    public $translatedAttributes =  ['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
