<?php

namespace Modules\ClubContact\Entities;

use Illuminate\Database\Eloquent\Model;

class ClubContact extends Model
{
    protected $table='club_contacts';
    protected $fillable = ['user_id','club_id','subject','msg'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function club(){
        return $this->belongsTo('Modules\FitnessClub\Entities\FitnessClub', 'club_id', 'id');
    }
}
