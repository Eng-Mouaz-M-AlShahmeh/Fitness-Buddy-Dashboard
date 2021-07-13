<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTranslation extends Model
{
    protected $table = 'subscription_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'subscriptions_trans_id';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = ['name','currency','period_days'];

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
