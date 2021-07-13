<?php

namespace Modules\Modifier\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use Translatable;
    protected $table='modifiers';
    protected $fillable = ['status'];
    public $translatedAttributes =  ['modifier'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
