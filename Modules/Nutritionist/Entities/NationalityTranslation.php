<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class NationalityTranslation extends Model
{
    protected $table = 'nationality_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'nationalities_trans_id';

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
