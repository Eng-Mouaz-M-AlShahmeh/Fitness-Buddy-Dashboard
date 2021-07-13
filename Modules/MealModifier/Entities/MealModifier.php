<?php

namespace Modules\MealModifier\Entities;

use Illuminate\Database\Eloquent\Model;

class MealModifier extends Model
{
    protected $table='meal_modifiers';
    protected $fillable = ['meal_id','modifier_id'];

    public function meal()
    {
        return $this->belongsTo('Modules\Meal\Entities\Meal','meal_id');
    }

    public function modifier()
    {
        return $this->belongsTo('Modules\Modifier\Entities\Modifier','modifier_id');
    }
}
