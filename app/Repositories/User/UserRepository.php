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
        $username=$request->get('user_name');
        $is_already_exists=$this->checkUsernameAlreadyExists($username);
        if($is_already_exists){
          $username=$this->generateUsername($request->get('user_name'));
        }
        $user->user_name = $username;
    }

    public function getUserFullName($user, $relation)
    {
        $userDetails = $user->$relation;

        $fullName = '';

        if (!empty($userDetails)) {
            $fullName = $userDetails->first_name . " " . $userDetails->last_name;
        }

        return $fullName;
    }

    private function checkUsernameAlreadyExists($username){
      $userCount=$this->user->where('user_name',$username)->count();
      $is_already_exists=$userCount>0?true:false;
      return $is_already_exists;
    }

    private function generateUsername($username){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($chars), 0, 2);
        $username= $username.''.rand(1,10).''.$randomString;
        $is_already_exists=$this->checkUsernameAlreadyExists($username);
        if(!isset($is_already_exists)){
            $this->generateUsername($username); 
        }
        return $username;
    }

}
