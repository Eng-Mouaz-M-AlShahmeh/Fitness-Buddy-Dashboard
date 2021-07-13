<?php

namespace Modules\Plan\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Translatable;
    protected $table='plans';
    protected $fillable = ['status'];
    public $translatedAttributes =  ['name','period_days'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
