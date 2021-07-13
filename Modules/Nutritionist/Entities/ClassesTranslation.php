<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class ClassesTranslation extends Model
{
    protected $table = 'class_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'classes_trans_id';

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
