<?php

namespace Modules\Nutritionist\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use Translatable;
    protected $table='nationalities';
    protected $fillable = ['status'];
    public $translatedAttributes =  ['name','locale'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
