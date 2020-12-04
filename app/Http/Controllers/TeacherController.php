<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Repositories\Role\RoleInterface;
use App\Repositories\Organization\OrganizationInterface;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Teacher\TeacherInterface;
use App\Http\Requests\Teacher\StoreTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(TeacherInterface $teacher, SectionInterface $section, OrganizationInterface $organization,RoleInterface $role)
    {
        $this->teacher = $teacher;
        $this->section = $section;
        $this->organization = $organization;
        $this->role = $role;
    }

    public function index()
    {
        $teachers = $this->teacher->getAll();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $sections = $this->section->getSectionsWithClassName();
            $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
            return view('teachers.create', compact('sections', 'organizations'));
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with([
                'alertType' => 'failure',
                'alertMessage' => 'Something went wrong.']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['roles' => $this->role->getRoleIdByName('Teacher')]);
            $this->teacher->create($request);
            DB::commit();
            return redirect()->route('teachers.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Teacher Created Successfully.']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Teacher Creation Failed.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
