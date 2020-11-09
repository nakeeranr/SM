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

    public function getAll()
    {
        return $this->permission->whereStatus(1)->get();
    }

    public function find($id)
    {
        return $this->permission->findOrFail($id);
    }

    public function create($request)
    {

        $permission = $this->permission;

        $this->buildObject($request, $permission);

        $permission->save();

        return $permission;
    }

    public function update($request, $id)
    {

        $permission = $this->permission->findOrFail($id);

        $this->buildObject($request, $permission);

        $permission->save();

        return $permission;
    }

    private function buildObject($request, $permission)
    {

        $permission->name = $request->get('name');

        $permission->description = $request->get('description');

        $permission->status = $request->get('status');
    }

    public function getPermissionNames()
    {
        return Permission::whereStatus(1)->pluck('name', 'id')->toArray();
    }

}
