<?php

namespace App\Repositories\Student;

interface StudentInterface
{
    public function getAll();

    public function find($id);

    public function create($request);

    public function update($request,$id);

    public function delete($id);
}