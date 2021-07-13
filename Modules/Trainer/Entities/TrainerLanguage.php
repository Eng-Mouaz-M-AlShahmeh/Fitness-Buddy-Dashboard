<?php

namespace Modules\Trainer\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerLanguage extends Model
{
    protected $table='trainer_languages';
    protected $fillable = ['trainer_id','language_id'];
    public function language()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Language','language_id');
    }
    public function trainer()
    {
        return $this->belongsTo('Modules\Trainer\Entities\Trainer','trainer_id');
    }
}
