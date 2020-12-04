<?php

namespace App\Repositories\Teacher;

use App\Models\Teacher;
use App\User;

class TeacherRepository implements TeacherInterface
{

    public function __construct(Teacher $teacher, User $user)
    {
        $this->teacher = $teacher;
        $this->user = $user;
    }

    public function getAll()
    {
        $orgID = $this->user->getMyOrgIdAttribute();
        $teachers = $this->teacher->whereStatus(1);
        if (!empty($orgID)) {
            $teachers = $teachers->where('organization_id', $orgID);
        }
        $teachers = $teachers->get();
        return $teachers;
    }

    public function find($id)
    {}

    public function create($request)
    {}

    public function update($request, $id)
    {}

    public function delete($id)
    {}

}
