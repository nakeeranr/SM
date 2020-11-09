<?php

namespace App\Repositories\User;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function create($request)
    {
        $user = $this->user;

        $this->buildObject($request, $user);

        $password = config('constants.DEFAULT_PASSWORD');

        $user->password = Hash::make($password);

        $user->save();

        $user->roles()->attach($request->get('roles'));

        return $user;
    }

    public function update($id, $request)
    {
        $user = $this->user->findorFail($id);

        $this->buildObject($request, $user);

        $user->save();

        $user->roles()->attach($request->get('roles'));

        return $user;
    }

    private function buildObject($request, $user)
    {
        $user->email = $request->get('email_id');

        $user->name = $request->get('user_name');
    }

}
