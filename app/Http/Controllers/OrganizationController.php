<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Models\Classes;
use App\Repositories\Organization\OrganizationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $organization;

    private $classes;

    public function __construct(OrganizationInterface $organization, Classes $classes)
    {
        $this->organization = $organization;
        $this->classes = $classes;
    }

    public function index()
    {
        try {
            $organizations = $this->organization->getAll();
            return view('organizations.index', compact('organizations'));
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
        try {
            $classes = $this->classes->whereStatus(1)->pluck('name', 'id')->toArray();
            $boards = config('constants.CURRICULUM');
            return view('organizations.create', compact('classes', 'boards'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
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
    public function store(StoreOrganizationRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->organization->create($request);
            DB::commit();
            return redirect()->route('organizations.index')
                ->with([
                    'alertType' => 'success',
                    'alertMessage' => 'Organization Registered Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Registration Failed.']);
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
            $organization = $this->organization->find($id);
            return view('organizations.show', compact('organization'));
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
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
            $organization = $this->organization->find($id);
            $classes = $this->classes->whereStatus(1)->pluck('name', 'id')->toArray();
            $boards = config('constants.CURRICULUM');
            $selectedClasses = $organization->classes->pluck('id')->toArray();
            return view('organizations.edit', compact('classes', 'boards', 'organization', 'selectedClasses'));
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Registration Failed.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    public function update(UpdateOrganizationRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->organization->update($request, $id);
            DB::commit();
            return redirect()->route('organizations.index')
                ->with([
                    'alertType' => 'success',
                    'alertMessage' => 'Organization Updated Successfully.']);

        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with([
                'alertType' => 'error',
                'alertMessage' => 'Organization Updation error.']);
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
