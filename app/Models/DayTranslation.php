<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayTranslation extends Model
{
    protected $table = 'day_translations';
    protected $primaryKey = 'days_trans_id';
    protected $fillable = ['name'];
    public $timestamps = false;
}
