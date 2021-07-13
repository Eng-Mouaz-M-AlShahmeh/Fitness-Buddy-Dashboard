<?php

namespace Modules\FitnessClub\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FitnessClubRating extends Model
{
    protected $table='fitness_clubs_rating';
    protected $fillable = ['user_id','club_id','rate','review'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
