<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Repositories\Permission\PermissionInterface;
use Exception;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    private $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $permissions = $this->permission->getAll();
            return view('permissions.index', compact('permissions'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('permissions.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->permission->create($request);
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('permissions.index')->with([
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
            $permission = $this->permission->find($id);
            return view('permissions.show', compact('permission'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('permissions.index')->with([
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
            $permission = $this->permission->find($id);
            return view('permissions.edit', compact('permission'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('permissions.index')->with([
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
    public function update(UpdatePermissionRequest $request, $id)
    {
        try {
            $this->permission->update($request, $id);
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('permissions.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Permission creation failed']);
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

    }
}
