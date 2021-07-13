<?php

namespace Modules\Meal\Entities;

use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
    protected $table = 'meal_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'meals_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','desc','currency','calorie'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
