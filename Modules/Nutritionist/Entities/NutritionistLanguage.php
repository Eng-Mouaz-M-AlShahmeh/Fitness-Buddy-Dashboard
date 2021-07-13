<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistLanguage extends Model
{
    protected $table='nutritionist_languages';
    protected $fillable = ['nutritionist_id','language_id'];

    public function nutritionist()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Nutritionist','nutritionist_id');
    }

    public function language()
    {
        return $this->belongsTo('Modules\Nutritionist\Entities\Language','language_id');
    }
}
