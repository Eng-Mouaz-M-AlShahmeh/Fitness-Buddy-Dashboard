<?php

namespace Modules\Subscription\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use Translatable;
    protected $table='subscriptions';
    protected $fillable = ['price','status'];
    public $translatedAttributes =  ['name','currency','period_days'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
