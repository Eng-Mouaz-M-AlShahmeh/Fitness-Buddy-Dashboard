<?php

namespace Modules\TrainerContact\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerContact extends Model
{
    protected $table='trainer_contacts';
    protected $fillable = ['user_id','trainer_id','subject','msg'];

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function trainer(){
        return $this->belongsTo('Modules\Trainer\Entities\Trainer', 'trainer_id', 'id');
    }
}
