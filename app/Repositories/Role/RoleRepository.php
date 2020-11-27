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

    /** To get all active records **/
    public function getAll()
    {
        return $this->roles->whereStatus(1)->orderBy('id', 'desc')->get();
    }

    /** To pluck on name for the given id **/
    public function getRoleIdByName($name)
    {
        return $this->roles->where('name', $name)->pluck('id')->first();
    }

    /** To get record based on given id **/
    public function find($id)
    {
        return $this->roles->findOrFail($id);
    }

    /** To insert a new record under roles table **/
    public function create($request)
    {
        $role = $this->roles;

        $this->buildObject($request, $role);

        $role->save();

        //To create/update the permissions for the particular role in role_permission table
        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }

    /** To update a record under roles table for the given id **/
    public function update($request, $id)
    {
        $role = $this->roles->findOrFail($id);

        $this->buildObject($request, $role);

        $role->save();

        //To create/update the permissions for the particular role in role_permission table
        $role->permissions()->sync($request->get('permissions'));

        return $role;
    }

    /** Framing the input params **/
    private function buildObject($request, $role)
    {
        $role->name = $request->get('name');

        $role->description = $request->get('description');

        $role->status = $request->get('status');
    }

    /** To delete the record from roles table for the given id **/
    public function delete($id)
    {
        $role = $this->roles->findOrFail($id);

        $role->permissions()->detach();

        $role->delete();
    }

}
