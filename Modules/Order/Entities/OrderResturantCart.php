<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderResturantCart extends Model
{
    protected $table='order_resturant_carts';
    protected $fillable = ['order_id','meal_id','quantity'];
    public function order(){
        return $this->belongsTo('Modules\Order\Entities\OrderResturant', 'order_id', 'id');
    }
    public function meal(){
        return $this->belongsTo('Modules\Meal\Entities\Meal', 'meal_id', 'id');
    }
}
