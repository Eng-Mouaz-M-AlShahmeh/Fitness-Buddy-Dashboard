<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderModifier extends Model
{
    protected $table='order_modifiers';
    protected $fillable = ['modifier_id','order_id'];
    public function modifier(){
        return $this->belongsTo('Modules\Modifier\Entities\Modifier', 'modifier_id', 'id');
    }
}
