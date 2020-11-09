<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'description', 'status',
    ];

    public function getStatusAttribute($value)
    {
        return config('constants.STATUS')[$value];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public static function createRole($request)
    {
        try {
            $params = $request->input();

            //Insert permission data
            $createRole = static::create([
                'name' => trim($params['name']),
                'description' => $params['description'],
                'status' => $params['status'],
            ]);

            $createRole->permissions()->sync($request->get('permissions'));

        } catch (\Exception $ex) {
            throw new GeneralException($ex->getMessage());
        }
    }

    public static function updateRole($request, $id)
    {
        try {
            $params = $request->input();
            $roleToBeUpdated = static::find($id);

            $updateRoleFields = [
                'name' => trim($params['name']),
                'description' => $params['description'],
                'status' => $params['status'],
            ];
            
            $roleToBeUpdated->update($updateRoleFields);
            return$roleToBeUpdated->permissions()->sync($request->get('permissions'));

        } catch (\Exception $ex) {
            throw new GeneralException($ex->getMessage());
        }
    }
}
