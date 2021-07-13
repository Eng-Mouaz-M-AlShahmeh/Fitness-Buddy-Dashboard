<?php

namespace Modules\Nutritionist\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NutritionistRate extends Model
{
    protected $table='nutriotionist_rates';
    protected $fillable = ['nutritionist_id','user_id','rate'];
    public function user(){
        return $this->belongsTo('Modules\Auth\Entities\User', 'user_id', 'id');
    }
    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
