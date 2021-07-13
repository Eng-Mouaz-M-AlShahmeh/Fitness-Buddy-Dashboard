<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey='id';
    protected $fillable = ['user_id','meal_id','quantity'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'user_id');
    }
    public function meal(){
        return $this->belongsTo('Modules\Meal\Entities\Meal', 'meal_id', 'meal_id');
    }

}
