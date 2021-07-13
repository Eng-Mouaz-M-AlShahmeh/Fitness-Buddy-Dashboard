<?php

namespace Modules\FitnessClub\Entities;

use Illuminate\Database\Eloquent\Model;

class ClubSubscription extends Model
{
    protected $table='club_subscriptions';
    protected $fillable = ['club_id','subscription_id'];

    public function club()
    {
        return $this->belongsTo('Modules\FitnessClub\Entities\FitnessClub','club_id');
    }

    public function subscription()
    {
        return $this->belongsTo('Modules\Subscription\Entities\Subscription','subscription_id');
    }
}
