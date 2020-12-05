<?php

namespace App\Repositories\Student;

use App\Models\Section;
use App\User;
use Illuminate\Support\Facades\Auth;

class StudentRepository implements StudentInterface
{

    public function __construct(Section $section, User $user)
    {
        $this->section = $section;
        $this->user = $user;
    }

    public function getAll()
    {
        
    }

    public function find($id)
    {
    }

    public function create($request)
    {
        
    }

    public function update($request, $id)
    {

        
    }

    private function buildObject($request, $section)
    {
        
    }

    public function delete($id)
    {
        
    }

    

}
