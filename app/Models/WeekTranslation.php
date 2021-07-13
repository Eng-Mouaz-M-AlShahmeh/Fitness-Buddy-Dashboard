<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeekTranslation extends Model
{
    protected $table = 'week_translations';


    protected $primaryKey = 'weeks_trans_id';


    protected $fillable = ['name'];


    public $timestamps = false;

}
