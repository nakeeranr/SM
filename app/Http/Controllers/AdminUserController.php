<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUser\StoreAdminUserRequest;
use App\Http\Requests\AdminUser\UpdateAdminUserRequest;
use App\Models\AdminUser;
use App\Repositories\AdminUser\AdminUserInterface;
use App\Repositories\Role\RoleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $adminUser;
    private $role;

    public function __construct(AdminUserInterface $adminUser, RoleInterface $role)
    {
        $this->adminUser = $adminUser;
        $this->role = $role;
    }

    public function index()
    {
        try {
            $adminUsers = $this->adminUser->getAll();
            return view('adminUsers.index', compact('adminUsers'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->back()->with([
                'alertType' => 'failure',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminUsers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminUserRequest $request)
    {

        DB::beginTransaction();
        try {

            $request->merge(['roles' => $this->role->getRoleIdByName('Administrator')]);
            $this->adminUser->create($request);
            DB::commit();

            return redirect()->route('admin-users.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Administrator Registered Successfully.']);

        } catch (\Exception $e) {

            logger($e->getMessage());

            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Administrator Registration Failed.']);

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

            $adminUser = AdminUser::findOrFail($id);
            return view('adminUsers.show', compact('adminUser'));

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
            $adminUser = $this->adminUser->find($id);
            return view('adminUsers.edit', compact('adminUser'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('admin-users.index')->with([
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
    public function update(UpdateAdminUserRequest $request, $id)
    {

        DB::beginTransaction();

        try {
            $request->merge(['roles' => $this->role->getRoleIdByName('Administrator')]);
            $this->adminUser->update($request, $id);
            DB::commit();

            return redirect()->route('admin-users.index')->with(['alertType' => 'success',
                'alertMessage' => 'Administrator Updated Successfully.']);

        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Administrator Updation Failed.']);

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
            $this->adminUser->delete($id);
            return redirect()->route('admin-users.index')->with(['alertType' => 'success',
                'alertMessage' => 'Administrator Deleted Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->route('admin-users.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Administrator Deletion Failed.']);
        }
    }

}
