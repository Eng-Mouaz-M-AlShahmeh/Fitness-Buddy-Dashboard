<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerOrder extends Model
{
    protected $table='trainer_orders';
    protected $fillable = ['user_id','trainer_id','total','order_number','accepted','payment_status','transaction_id'];
    public function trainer(){
        return $this->belongsTo('Modules\Trainer\Entities\Trainer', 'trainer_id', 'id');
    }

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
}
