<?php

namespace Modules\Trainer\Entities;

use Illuminate\Database\Eloquent\Model;

class TrainerTranslation extends Model
{
    protected $table = 'trainer_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'trainers_trans_id';

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
