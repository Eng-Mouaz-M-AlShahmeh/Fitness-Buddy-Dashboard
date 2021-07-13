<?php

namespace Modules\Trainer\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerImageTranslation extends Model
{
    protected $table = 'trainer_images_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trainer_images_trans_id';

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
