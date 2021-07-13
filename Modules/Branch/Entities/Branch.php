<?php

namespace Modules\Branch\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Resturant\Entities\Resturant;

class Branch extends Model
{
   use Translatable;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'branches';

    protected $fillable = ['status', 'lat', 'lng','resturant_id'];
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


    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function resturant()
    {
        return $this->belongsTo(Resturant::class, 'resturant_id', 'id');
    }
}
