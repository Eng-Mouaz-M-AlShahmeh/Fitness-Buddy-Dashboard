<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class SettingsTranslation extends Model
{
    protected $table = 'setting_translations';
    protected $primaryKey = 'settings_trans_id';
    protected $fillable = ['about','privacy','name'];
    public $timestamps = false;
}
