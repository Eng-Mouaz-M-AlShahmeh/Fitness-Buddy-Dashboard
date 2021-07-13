<?php

namespace Modules\NutritionistSlider\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistSliderTranslation extends Model
{
    protected $table = 'nutritionist_slider_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'nutritionist_sliders_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['title','description'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
