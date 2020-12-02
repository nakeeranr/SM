<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Auth;
use Greatsami\Entrust\Traits\EntrustUserTrait;

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

    public function getMyOrgIdAttribute(){

        //sample code 
        $role_name = Auth::user()->roles->pluck('name')->first();
        $relation = config('constants.ROLE_PROFILE.' . $role_name . '.userRelation');
        $user = Auth::user();
        if (isset($user->$relation)) {
            if (isset($user->$relation->hospital) && !empty(isset($user->$relation->hospital)) && isset($user->$relation->hospital->id)) {
                return $user->$relation->hospital->id;
            } else {
                return null;
            }
        } else {
            return null;
        }

        $hospitalId = $this->user->getMyHospitalId();
        if(!empty($hospitalId)){
            return $this->hospital->whereId($hospitalId)->pluck('name','id');   
        }else{
            return $this->hospital->pluck('name', 'id');
        }

        
    }
}
