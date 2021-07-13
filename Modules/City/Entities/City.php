<?php

namespace Modules\City\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Translatable;
    protected $table='cities';
    public $translatedAttributes = ['name'];
    protected $fillable = ['status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
