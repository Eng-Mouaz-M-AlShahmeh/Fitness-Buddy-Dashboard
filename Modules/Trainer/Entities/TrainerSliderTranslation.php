<?php

namespace Modules\Trainer\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerSliderTranslation extends Model
{
    protected $table = 'trainer_slider_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trainer_sliders_trans_id';

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
