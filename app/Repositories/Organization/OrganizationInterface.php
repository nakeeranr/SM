<?php

namespace App\Repositories\Organization;

interface OrganizationInterface
{
    
    public function getAll();

    public function find($id);

    public function create($request);

    public function update($request, $id);

    public function delete($id);

    public function getOrgWithClass($id);
}
?>