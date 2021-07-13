<?php

namespace Modules\FitnessClub\Entities;

use Illuminate\Database\Eloquent\Model;

class FitnessClubTranslation extends Model
{
    protected $table = 'fitness_club_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'fitness_clubs_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','desc'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
