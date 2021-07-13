<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistTranslation extends Model
{
    protected $table = 'nutritionist_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'nutritionists_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','about','level','currency','class'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
