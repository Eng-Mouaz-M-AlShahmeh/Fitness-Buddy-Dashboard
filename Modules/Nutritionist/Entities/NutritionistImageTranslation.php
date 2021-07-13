<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class NutritionistImageTranslation extends Model
{
    protected $table = 'nutritionist_images_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'nutritionist_images_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
