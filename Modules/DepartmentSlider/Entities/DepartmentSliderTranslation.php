<?php

namespace Modules\DepartmentSlider\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentSliderTranslation extends Model
{
    protected $table = 'dept_slides_trans';
    protected $fillable = ['desc','title'];
    protected $primaryKey = 'dept_slides_trans_id';
    public $timestamps = false;
}
