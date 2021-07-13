<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentPlan extends Model
{
    protected $table='department_plans';
    protected $fillable = ['dept_id','plan_id'];

    public function department()
    {
        return $this->belongsTo('Modules\Department\Entities\Department','dept_id');
    }

    public function plan()
    {
        return $this->belongsTo('Modules\Plan\Entities\Plan','plan_id');
    }
}
