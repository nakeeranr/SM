<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'status',
    ];

    public function getStatusAttribute($value)
    {
        return config('constants.STATUS')[$value];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
