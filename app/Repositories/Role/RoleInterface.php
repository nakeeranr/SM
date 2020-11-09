<?php

namespace App\Repositories\Role;

interface RoleInterface
{
    public function getAll();

    public function getRoleIdByName($name);

    public function find($id);

    public function create($request);

    public function update($request,$id);
}