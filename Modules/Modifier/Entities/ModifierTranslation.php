<?php

namespace Modules\Modifier\Entities;

use Illuminate\Database\Eloquent\Model;

class ModifierTranslation extends Model
{
    protected $table = 'modifier_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'modifiers_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['modifier'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
