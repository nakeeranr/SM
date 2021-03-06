<?php

namespace App\Repositories\Teacher;

use App\Models\Teacher;
use App\Repositories\User\UserInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class TeacherRepository implements TeacherInterface
{

    public function __construct(Teacher $teacher, UserInterface $user, User $userModel)
    {
        $this->teacher = $teacher;
        $this->user = $user;
        $this->userModel = $userModel;
    }

    public function getAll()
    {
        $orgID = $this->userModel->getMyOrgIdAttribute();
        $teachers = $this->teacher->whereStatus(1);
        if (!empty($orgID)) {
            $teachers = $teachers->where('teacher_id', $orgID);
        }
        $teachers = $teachers->get();
        return $teachers;
    }

    public function find($id)
    {
        return $this->teacher->findOrFail($id);
    }

    public function create($request)
    {
        $teacher = $this->teacher;

        $this->buildObject($request, $teacher);

        $teacher->created_by = Auth::id();

        $teacher->updated_by = Auth::id();

        $user = $this->user->create($request);

        $teacher->user()->associate($user);

        $teacher->save();

        $teacher->section()->sync($request->get('sections'));

        return $teacher;
    }

    public function update($request, $id)
    {
        $teacher = $this->teacher->findOrFail($id);

        $this->buildObject($request, $teacher);

        $teacher->updated_by = Auth::id();

        $user = $this->user->update($teacher->user_id, $request);

        $teacher->user()->associate($user);

        $teacher->save();

        $teacher->section()->sync($request->get('sections'));

        return $teacher;
    }

    private function buildObject($request, $teacher)
    {
        $teacher->first_name = $request->get('first_name');

        $teacher->last_name = $request->has('last_name') ? $request->get('last_name') : null;

        $teacher->phone_number = $request->has('phone_number') ? $request->get('phone_number') : null;

        $teacher->gender = $request->has('gender') ? $request->get('gender') : null;

        $teacher->dob = $request->filled('dob') ? $request->get('dob') : null;

        $teacher->status = $request->has('status') ? $request->get('status') : null;

        $teacher->address = $request->get('address');

        $teacher->city = $request->get('city');

        $teacher->state = $request->get('state');

        $teacher->country = $request->get('country');

        $teacher->pin_code = $request->get('pin_code');

        $teacher->qualification = $request->get('qualification');

        $teacher->certification = $request->get('certification');

        $teacher->experience_details = $request->get('experience_details');

        $teacher->organization_id = $request->get('organization_id');

        $teacher->subject = $request->get('subject');

    }

    public function delete($id)
    {
        $teacher = $this->teacher->findOrFail($id);

        $teacher->section()->detach();

        $teacher->delete();
    }

}
