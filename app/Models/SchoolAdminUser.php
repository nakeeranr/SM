<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolAdminUser extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function getStatusAttribute($value)
    {

        return config('constants.STATUS')[$value];
    }

    public function getDobAttribute($value)
    {

        return date('d F, Y', strtotime($value));
    }

    public function getFullNameAttribute()
    {

        return $this->first_name . ' ' . $this->last_name;
    }

    public function getGenderAttribute($value)
    {

        return config('constants.GENDER_ENUM')[$value];
    }

    public function getCreatedAtAttribute($value)
    {

        return date('d F, Y', strtotime($value));
    }

}
