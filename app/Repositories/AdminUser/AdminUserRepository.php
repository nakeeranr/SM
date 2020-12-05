<?php

namespace App\Repositories\AdminUser;

use App\Models\AdminUser;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Auth;

class AdminUserRepository implements AdminUserInterface
{

    private $adminUser;

    private $user;

    public function __construct(AdminUser $adminUser, UserInterface $user)
    {
        $this->adminUser = $adminUser;
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->adminUser->all();
    }

    public function find($id)
    {
        return $this->adminUser->with('user', 'user.roles')->findOrFail($id);
    }

    public function create($request)
    {
        $adminUser = $this->adminUser;

        $this->buildObject($request, $adminUser);

        $adminUser->created_by = Auth::id();

        $adminUser->updated_by = Auth::id();

        $user = $this->user->create($request);

        $adminUser->user()->associate($user);

        $adminUser->save();

        return $adminUser;
    }

    public function update($request, $id)
    {
        $adminUser = $this->adminUser->findorFail($id);

        $this->buildObject($request, $adminUser);

        $adminUser->updated_by = Auth::id();

        $user = $this->user->update($adminUser->user_id, $request);

        $adminUser->save();

        return $adminUser;
    }

    private function buildObject($request, $adminUser)
    {
        $adminUser->first_name = $request->get('first_name');

        $adminUser->last_name = $request->has('last_name') ? $request->get('last_name') : null;

        $adminUser->phone_number = $request->has('phone_number') ? $request->get('phone_number') : null;

        $adminUser->gender = $request->has('gender') ? $request->get('gender') : null;

        $adminUser->dob = $request->filled('dob') ? $request->get('dob') : null;

        $adminUser->status = $request->has('status') ? $request->get('status') : null;

    }

    public function delete($id)
    {
        $adminUser = $this->adminUser->findorFail($id);

        $adminUser->delete();
    }

}
