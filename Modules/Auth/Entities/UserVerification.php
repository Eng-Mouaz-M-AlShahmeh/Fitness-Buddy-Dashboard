<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $table="verifications";

    protected $primaryKey='id';




    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable=['user_id', 'verifications_code'];



    public function related_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');

    }
}
