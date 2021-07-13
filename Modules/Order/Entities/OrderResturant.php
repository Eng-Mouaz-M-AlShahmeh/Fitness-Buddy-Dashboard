<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderResturant extends Model
{
    protected $table='order_resturants';
    protected $fillable = ['user_id','resturant_id','total','status','accepted','order_number','payment_status','transaction_id','created_at','updated_at','ended_at','pause_period'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function resturant(){
        return $this->belongsTo('Modules\Resturant\Entities\Resturant', 'resturant_id', 'id');
    }
}
