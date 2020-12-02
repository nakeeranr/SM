<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Organization\OrganizationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct(SectionInterface $section, Classes $classes, OrganizationInterface $organization)
    {
        $this->section = $section;
        $this->classes = $classes;
        $this->organization = $organization;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = [];
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $this->role =$user->roles->first()->name;
        dd($this->role);
        try {
            $classes = $this->classes->whereStatus(1)->pluck('name', 'id')->toArray();
            $organizations = $this->organization->getAll()->pluck('name', 'id')->toArray();
            return view('sections.create', compact('classes','organizations'));
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
    public function store(Request $request)
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
