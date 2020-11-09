<?php

namespace App\Repositories\Permission;

interface PermissionInterface
{
    public function getAll();

    public function find($id);

    public function create($request);

    public function update($request,$id);

    public function getPermissionNames();
}