<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class AdminUser extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value) {

        return config('constants.STATUS')[$value];
    }

    public function getDobAttribute($value) {

        return date('d F, Y', strtotime($value));
    }

    public function getFullNameAttribute() {

        return $this->first_name . ' ' . $this->last_name;
    }

    public function getGenderAttribute($value) {
        
        return config('constants.GENDER_ENUM')[$value];
    }

    public function getCreatedAtAttribute($value) {

        return date('d F, Y', strtotime($value));
    }

}
