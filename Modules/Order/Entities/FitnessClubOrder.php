<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class FitnessClubOrder extends Model
{
    protected $table='fitness_club_orders';
    protected $fillable = ['fitness_club_id','subscription_id','user_id','accepted','total','order_number','payment_status'
        ,'transaction_id','pause_period','ended_at','created_at','updated_at'];

    public function club(){
        return $this->belongsTo('Modules\FitnessClub\Entities\FitnessClub', 'fitness_club_id', 'id');
    }

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }

    public function subscription(){
        return $this->belongsTo('Modules\Subscription\Entities\Subscription', 'subscription_id', 'id');
    }
}
