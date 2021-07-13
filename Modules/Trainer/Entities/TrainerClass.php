<?php

namespace Modules\Trainer\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerClass extends Model
{
    protected $table='trainer_classes';
    protected $fillable = ['trainer_id','class_id'];

    public function trainer()
    {
        return $this->belongsTo('Modules\Trainer\Entities\Trainer','trainer_id');
    }

    public function class()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Classes','class_id');
    }
}
