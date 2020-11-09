<?php

namespace App\Repositories\Role;

use App\Models\Role;

class RoleRepository implements RoleInterface
{

    private $roles;

    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    public function getAll()
    {
        return $this->roles->whereStatus(1)->orderBy('id','desc')->get();
    }

    public function getRoleIdByName($name)
    {
        return $this->roles->where('name', $name)->pluck('id')->first();
    }

    public function find($id)
    {
        return $this->roles->findOrFail($id);
    }

    public function create($request)
    {

        $role = $this->roles;

        $this->buildObject($request, $role);

        $role->save();

        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }

    public function update($request, $id)
    {

        $role = $this->roles->findOrFail($id);

        $this->buildObject($request, $role);

        $role->save();

        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }

    private function buildObject($request, $role)
    {

        $role->name = $request->get('name');

        $role->description = $request->get('description');

        $role->status = $request->get('status');
    }

}
