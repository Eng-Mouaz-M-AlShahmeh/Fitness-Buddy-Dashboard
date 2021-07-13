<?php

namespace Modules\Resturant\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ResturantRating extends Model
{
    protected $table='resturant_ratings';
    protected $fillable = ['user_id', 'resturant_id', 'rating'];

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
