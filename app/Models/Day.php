<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use Translatable;
    protected $table='days';
    public $translatedAttributes =  ['name'];
    protected $fillable = ['status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
