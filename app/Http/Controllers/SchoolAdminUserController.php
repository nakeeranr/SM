<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Organization\OrganizationInterface;
use App\Http\Requests\SchoolAdminUser\StoreSchoolAdminUserRequest;
use App\Http\Requests\SchoolAdminUser\UpdateSchoolAdminUserRequest;
use App\Repositories\Role\RoleInterface;
use App\Repositories\SchoolAdminUser\SchoolAdminUserInterface;

class SchoolAdminUserController extends Controller
{

    private $organization;
    public function __construct(OrganizationInterface $organization , RoleInterface $role , SchoolAdminUserInterface $schoolAdminUser)
    {
        $this->organization = $organization;
        $this->role = $role;
        $this->schoolAdminUser = $schoolAdminUser;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolAdminUser = $this->schoolAdminUser->getAll();
        return view('school_admin.index', compact('schoolAdminUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
        return view('school_admin.create',compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolAdminUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['roles' => $this->role->getRoleIdByName('School Administrator')]);
            $this->schoolAdminUser->create($request);
            DB::commit();
            return redirect()->route('org-admin.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Organization Admin User Created Successfully.']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Admin User Creation Failed.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $schoolAdminUser = $this->schoolAdminUser->find($id);
            return view('school_admin.show', compact('schoolAdminUser'));

        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('admin-users.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $schoolAdminUser = $this->schoolAdminUser->find($id);
            $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
            return view('school_admin.edit', compact('schoolAdminUser','organizations'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('org-admin.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolAdminUserRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $request->merge(['roles' => $this->role->getRoleIdByName('Administrator')]);
            $this->schoolAdminUser->update($request, $id);
            DB::commit();
            return redirect()->route('org-admin.index')->with(['alertType' => 'success',
                'alertMessage' => 'Organization Admin User Updated Successfully.']);

        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Admin User Updation Failed.']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->schoolAdminUser->delete($id);
            return redirect()->route('org-admin.index')->with(['alertType' => 'success',
                'alertMessage' => 'Organization Admin User Deleted Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->route('org-admin.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Admin User Deletion Failed.']);
        }
    }
}
