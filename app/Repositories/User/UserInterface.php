<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function getAll();

    public function create($request);

    public function update($id,$request);
}