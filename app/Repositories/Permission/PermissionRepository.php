<?php

namespace App\Repositories\Permission;

use App\Models\Permission;

class PermissionRepository implements PermissionInterface
{

    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /** To get all active records **/
    public function getAll()
    {
        return $this->permission->all();
    }

    /** To get record based on given id **/
    public function find($id)
    {
        return $this->permission->findOrFail($id);
    }

    /** To insert a new record under permissions table **/
    public function create($request)
    {
        $permission = $this->permission;

        $this->buildObject($request, $permission);

        $permission->save();

        return $permission;
    }

    /** To update a record under permissions table for the given id **/
    public function update($request, $id)
    {
        $permission = $this->permission->findOrFail($id);

        $this->buildObject($request, $permission);

        $permission->save();

        return $permission;
    }

    /** Framing the input params **/
    private function buildObject($request, $permission)
    {
        $permission->name = $request->get('name');

        $permission->description = $request->get('description');

        $permission->status = $request->get('status');
    }

    /** To get only permission names and id for dropdown **/
    public function getPermissionNames()
    {
        return Permission::whereStatus(1)->pluck('name', 'id')->toArray();
    }

    /** To delete the record from permissions table for the given id **/
    public function delete($id)
    {
        $permission = $this->permission->findOrFail($id);

        $permission->delete();
    }

}
