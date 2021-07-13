<?php

namespace Modules\Plan\Entities;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    protected $table = 'plan_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'plans_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','period_days'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

}
