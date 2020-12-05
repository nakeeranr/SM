<?php

namespace App\Repositories\SchoolAdminUser;

use App\Models\SchoolAdminUser;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;

class SchoolAdminUserRepository implements SchoolAdminUserInterface
{

    private $schoolAdminUser;

    private $user;

    public function __construct(SchoolAdminUser $schoolAdminUser, UserInterface $user)
    {
        $this->schoolAdminUser = $schoolAdminUser;
        
        $this->user = $user;
    }

    public function getAll(){
       return $this->schoolAdminUser->all();
    }

    public function find($id){
        return $this->schoolAdminUser->with('user', 'user.roles')->findOrFail($id);
    }

    public function create($request)
    {
        $schoolAdminUser = $this->schoolAdminUser;

        $this->buildObject($request, $schoolAdminUser);

        $schoolAdminUser->created_by = Auth::id();

        $schoolAdminUser->updated_by = Auth::id();

        $user = $this->user->create($request);

        $schoolAdminUser->user()->associate($user);

        $schoolAdminUser->save();

        return $schoolAdminUser;
    }

    public function update($request,$id){
        
        $schoolAdminUser = $this->schoolAdminUser->findorFail($id);

        $this->buildObject($request, $schoolAdminUser);

        $schoolAdminUser->updated_by = Auth::id();

        $user = $this->user->update($schoolAdminUser->user_id, $request);

        $schoolAdminUser->save();

        return $schoolAdminUser;
    }

    private function buildObject($request, $schoolAdminUser)
    {

        $schoolAdminUser->first_name = $request->get('first_name');

        $schoolAdminUser->last_name = $request->has('last_name') ? $request->get('last_name') : null;

        $schoolAdminUser->phone_number = $request->has('phone_number') ? $request->get('phone_number') : null;

        $schoolAdminUser->gender = $request->has('gender') ? $request->get('gender') : null;

        $schoolAdminUser->dob = $request->filled('dob') ? $request->get('dob') : null;

        $schoolAdminUser->status = $request->has('status') ? $request->get('status') : null;

        $schoolAdminUser->organization_id = $request->has('organizationID') ? $request->get('organizationID') : null;
    }

    public function delete($id)
    {
        $schoolAdminUser = $this->schoolAdminUser->findorFail($id);

        $schoolAdminUser->delete();
    }

}
