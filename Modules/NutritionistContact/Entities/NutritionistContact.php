<?php

namespace Modules\NutritionistContact\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistContact extends Model
{
    protected $table='nutri_contacts';
    protected $fillable = ['user_id','nutri_id','subject','msg'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function nutri(){
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist', 'nutri_id', 'id');
    }
}
