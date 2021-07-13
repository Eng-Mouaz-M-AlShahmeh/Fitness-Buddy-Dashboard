<?php

namespace Modules\Branch\Entities;

use Illuminate\Database\Eloquent\Model;

class BranchTranslation extends Model
{
    protected $table = 'branch_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'branches_trans_id';

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
