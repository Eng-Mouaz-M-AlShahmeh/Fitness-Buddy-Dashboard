<?php

namespace Modules\Resturant\Entities;

use Illuminate\Database\Eloquent\Model;

class ResturantTranslation extends Model
{
    protected $table = 'resturant_translations';


    protected $primaryKey = 'resturants_trans_id';


    protected $fillable = ['name','offer','min','price','terms'];


    public $timestamps = false;
}
