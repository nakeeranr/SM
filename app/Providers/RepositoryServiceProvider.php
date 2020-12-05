<?php

namespace App\Providers;

use App\Repositories\AdminUser\AdminUserInterface;
use App\Repositories\AdminUser\AdminUserRepository;

use App\Repositories\Organization\OrganizationInterface;
use App\Repositories\Organization\OrganizationRepository;

use App\Repositories\Role\RoleInterface;
use App\Repositories\Role\RoleRepository;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Repositories\SchoolAdminUser\SchoolAdminUserInterface;
use App\Repositories\SchoolAdminUser\SchoolAdminUserRepository;

use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Permission\PermissionRepository;

use App\Repositories\Section\SectionInterface;
use App\Repositories\Section\SectionRepository;

use App\Repositories\Teacher\TeacherInterface;
use App\Repositories\Teacher\TeacherRepository;

use App\Repositories\Student\StudentInterface;
use App\Repositories\Student\StudentRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(AdminUserInterface::class, AdminUserRepository::class);
        $this->app->bind(OrganizationInterface::class, OrganizationRepository::class);
        $this->app->bind(SchoolAdminUserInterface::class,SchoolAdminUserRepository::class);
        $this->app->bind(SectionInterface::class,SectionRepository::class);
        $this->app->bind(TeacherInterface::class,TeacherRepository::class);
        $this->app->bind(StudentInterface::class,StudentRepository::class);
    }

    public function provides()
    {
        return [
            PermissionInterface::class,
            RoleInterface::class,
            UserInterface::class,
            AdminUserInterface::class,
            OrganizationInterface::class,
            SchoolAdminUserInterface::class,
            SectionInterface::class,
            TeacherInterface::class,
            StudentInterface::class
        ];
    }
}
