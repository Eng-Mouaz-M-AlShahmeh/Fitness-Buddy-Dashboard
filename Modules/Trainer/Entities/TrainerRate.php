<?php

namespace Modules\Trainer\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TrainerRate extends Model
{
    protected $table='trainer_rates';
    protected $fillable = ['trainer_id','user_id','rate'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
