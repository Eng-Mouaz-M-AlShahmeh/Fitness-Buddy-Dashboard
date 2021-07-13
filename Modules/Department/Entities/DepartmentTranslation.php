<?php

namespace Modules\Department\Entities;

use Illuminate\Database\Eloquent\Model;

class DepartmentTranslation extends Model
{
    protected $table = 'department_translations';
    protected $fillable = ['name','title'];
    protected $primaryKey = 'departments_trans_id';
    public $timestamps = false;
}
