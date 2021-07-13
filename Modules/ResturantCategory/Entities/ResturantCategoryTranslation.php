<?php

namespace Modules\ResturantCategory\Entities;

use Illuminate\Database\Eloquent\Model;

class ResturantCategoryTranslation extends Model
{
    protected $table = 'rest_cats_translations';


    protected $primaryKey = 'rest_cats_trans_id';


    protected $fillable = ['name'];


    public $timestamps = false;
}
