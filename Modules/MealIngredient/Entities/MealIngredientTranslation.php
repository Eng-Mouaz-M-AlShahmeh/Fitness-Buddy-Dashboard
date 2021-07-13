<?php

namespace Modules\MealIngredient\Entities;

use Illuminate\Database\Eloquent\Model;

class MealIngredientTranslation extends Model
{
    protected $table = 'meal_ingrediants_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'meal_ingrediants_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['ingredient','calories'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
