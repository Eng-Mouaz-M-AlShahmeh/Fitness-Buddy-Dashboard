<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistOrder extends Model
{
    protected $table='nutritionist_orders';
    protected $fillable = ['user_id','nutritionist_id','total','order_number','accepted','payment_status','transaction_id'];
    public function nutritionist(){
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist', 'nutritionist_id', 'id');
    }

    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
}
