<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table='coupons';
    protected $fillable = ['code','start_at','end_at','usage_number','status'];
}
