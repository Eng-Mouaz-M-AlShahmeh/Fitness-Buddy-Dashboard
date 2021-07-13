<?php

namespace Modules\FitnessClub\Entities;

use Illuminate\Database\Eloquent\Model;

class ClubActivity extends Model
{
    protected $table='club_activities';
    protected $fillable = ['club_id','icon'];

    public function getIconAttribute($value)
    {
        if ($value) {
            return asset('uploads/clubs/activity/'.$value);
        } else {
            return asset('uploads/clubs/activity/default.png');
        }
    }

    public function setIconAttribute($value)
    {
        if ($value)
        {
            $imageName=time().'.'.$value->getClientOriginalExtension();
            $value->move(public_path('uploads/clubs/activity/'),$imageName);
            $this->attributes['icon']=$imageName;
        }
    }

        public function club()
        {
            return $this->belongsTo('Modules\FitnessClub\Entities\FitnessClub','club_id');
        }
}
