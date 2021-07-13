<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use Translatable;
    protected $table = 'weeks';

    /**
     * Primary key.
     *
     * @var string
     */

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  ['name'];

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'id'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
