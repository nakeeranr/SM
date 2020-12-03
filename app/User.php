<?php

namespace App;

use App\Models\AdminUser;
use App\Models\Role;
use App\Models\SchoolAdminUser;
use Auth;
use Greatsami\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function admin()
    {
        return $this->hasOne(AdminUser::class, 'user_id');
    }

    public function schoolAdmin()
    {
        return $this->hasOne(SchoolAdminUser::class, 'user_id');
    }

    public function getMyOrgIdAttribute()
    {
        $role_name = Auth::user()->roles->pluck('slug_name')->first();
       
        $relation = config('constants.ROLE_PROFILE.' . $role_name . '.userRelation');
        $user = Auth::user();
        if (isset($user->$relation)) {
            if (isset($user->$relation->organization) && !empty(isset($user->$relation->organization)) && isset($user->$relation->organization->id)) {
                return $user->$relation->organization->id;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
