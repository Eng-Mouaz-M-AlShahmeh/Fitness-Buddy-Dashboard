<?php

namespace Modules\ResturantSlider\Entities;

use Illuminate\Database\Eloquent\Model;

class ResturantSliderTranslation extends Model
{
    protected $table = 'resturant_slider_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'resturant_sliders_trans_id';

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
