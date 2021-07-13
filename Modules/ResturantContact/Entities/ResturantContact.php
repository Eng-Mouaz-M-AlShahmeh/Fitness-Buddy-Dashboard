<?php

namespace Modules\ResturantContact\Entities;

use Illuminate\Database\Eloquent\Model;

class ResturantContact extends Model
{
    protected $table='resturant_contacts';
    protected $fillable = ['user_id','rest_id','subject','msg'];

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function rest(){
        return $this->belongsTo('Modules\Resturant\Entities\Resturant', 'rest_id', 'id');
    }
}
