<?php

namespace Modules\City\Entities;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $table = 'city_translations';


    protected $primaryKey = 'cities_trans_id';


    protected $fillable = ['name'];


    public $timestamps = false;
}
