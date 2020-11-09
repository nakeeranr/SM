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

    

}