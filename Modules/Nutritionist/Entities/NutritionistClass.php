<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistClass extends Model
{
    protected $table='nutritionist_classes';
    protected $fillable = ['nutritionist_id','class_id'];

    public function nutritionist()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist','nutritionist_id');
    }

    public function class()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Classes','class_id');
    }
}
