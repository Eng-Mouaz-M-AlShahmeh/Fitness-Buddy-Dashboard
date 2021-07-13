<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    protected $table='coupon_user';
    protected $fillable = ['user_id','coupon_id'];
}
