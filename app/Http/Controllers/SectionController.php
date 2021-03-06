<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\User;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Organization\OrganizationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Section\StoreSectionRequest;
use App\Http\Requests\Section\UpdateSectionRequest;


class SectionController extends Controller
{
    public function __construct(SectionInterface $section, Classes $classes, OrganizationInterface $organization, User $user)
    {
        $this->section = $section;
        $this->classes = $classes;
        $this->organization = $organization;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->section->getAll();
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $orgID=$this->user->getMyOrgIdAttribute();
            $classes=$this->classes->whereStatus(1)->whereHas('organization', function ($query) use ($orgID) {
                if(!empty($orgID) && isset($orgID)){
                    $query->where('organization_id',$orgID);  
                } 
            })->pluck('name','id')->toArray();
            $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
            return view('sections.create', compact('classes','organizations','orgID'));
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
    public function store(StoreSectionRequest $request)
    {
        try {
            $section = $this->section->create($request);
            return redirect()->route('sections.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Sections Registered Successfully.']);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with([
                'alertType' => 'failure',
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
            $section = $this->section->find($id);
            return view('sections.show', compact('section'));
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect()->route('sections.index')->with([
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
            $section = $this->section->find($id);
            $orgID=$this->user->getMyOrgIdAttribute();
            $classes=$this->classes->whereStatus(1)->whereHas('organization', function ($query) use ($orgID) {
                if(!empty($orgID) && isset($orgID)){
                    $query->where('organization_id',$orgID);  
                } 
            })->pluck('name','id')->toArray();
            $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
            return view('sections.edit', compact('classes','organizations','orgID','section'));
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
    public function update(UpdateSectionRequest $request, $id)
    {
        try {
            $section = $this->section->update($request,$id);
            return redirect()->route('sections.index')->with([
                'alertType' => 'success',
                'alertMessage' => 'Sections Registered Successfully.']);
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            return redirect()->back()->with([
                'alertType' => 'failure',
                'alertMessage' => 'Something went wrong.']);
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
            $this->section->delete($id);
            return redirect()->route('sections.index')->with(['alertType' => 'success',
                'alertMessage' => 'Section Deleted Successfully.']);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->route('sections.index')->with([
                'alertType' => 'error',
                'alertMessage' => 'Section Deletion Failed.']);
        }
    }

    public function getClassDetailsMappedWithOrg(Request $request){
        $orgID=$request->orgID;
        $classes=$this->classes->whereStatus(1)->whereHas('organization', function ($query) use ($orgID) {
            if(!empty($orgID) && isset($orgID)){
                    $query->where('organization_id',$orgID);  
            } 
        })->pluck('name','id')->toArray();
        return  $classes;
    }
}
