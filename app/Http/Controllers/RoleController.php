<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Permission\PermissionInterface;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $role;
    private $permission;

    public function __construct(RoleInterface $role,PermissionInterface $permission)
    {
        $this->role = $role;
        $this->permission=$permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = $this->role->getAll();
            return view('roles.index', compact('roles'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('roles.index')->with([
                'alertType' => 'error',
                'alertMessage' => "Something went wrong."]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $permissions = $this->permission->getPermissionNames();
            return view('roles.create', compact('permissions'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('roles.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {try {
        $this->role->create($request);
        return redirect()->route('roles.index')->with([
            'alertType' => 'success',
            'alertMessage' => 'Role created Successfully.']);
    } catch (\Exception $ex) {
        logger($ex->getMessage());
        return redirect()->route('roles.index')->with([
            'alertType' => 'error',
            'alertMessage' => 'Something went wrong.']);
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
            $role = $this->role->find($id);
            return view('roles.show', compact('role'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('roles.index')->with([
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
            $role = $this->role->find($id);
            $selectedPermissions = $role->permissions->pluck('id')->toArray();
            $permissions = $this->permission->getPermissionNames();
            return view('roles.edit', compact('role', 'permissions', 'selectedPermissions'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('roles.index')->with([
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
    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            $this->role->update($request, $id);
            return redirect()->route('roles.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Role Updated Successfully.']);
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('roles.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Role Updation Failed.']);
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
        //
    }
}
