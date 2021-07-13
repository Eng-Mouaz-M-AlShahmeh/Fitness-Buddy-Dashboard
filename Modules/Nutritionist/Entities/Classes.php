<?php

namespace Modules\Nutritionist\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use Translatable;
    protected $table='classes';
    protected $fillable = ['time','status'];
    public $translatedAttributes =  ['name'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
