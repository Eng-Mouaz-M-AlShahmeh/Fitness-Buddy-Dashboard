<?php

namespace Modules\Nutritionist\Entities;

use Illuminate\Database\Eloquent\Model;

class LanguageTranslation extends Model
{
    protected $table = 'language_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'languages_trans_id';

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
