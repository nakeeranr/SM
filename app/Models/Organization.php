<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    use SoftDeletes;

    public function classes()
    {
        return $this->belongsToMany(classes::class, 'organizations_classes');
    }

    public function getStatusAttribute($value) {

        return config('constants.STATUS')[$value];
    }

    public function getCurriculumAttribute($value) {

    	return config('constants.CURRICULUM')[$value];
    }

    public function orgClass() 
    {
        return $this->classes()->select('id', 'name');

    }

}
