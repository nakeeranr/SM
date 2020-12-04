<?php

namespace App\Repositories\Section;

use App\Models\Section;
use App\User;
use Illuminate\Support\Facades\Auth;

class SectionRepository implements SectionInterface
{

    public function __construct(Section $section, User $user)
    {
        $this->section = $section;
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->section->all();
    }

    public function find($id)
    {
        return $this->section->findOrFail($id);
    }

    public function create($request)
    {
        $section = $this->section;

        $this->buildObject($request, $section);

        $section->created_by = Auth::id();

        $section->updated_by = Auth::id();

        $section->save();

        return $section;
    }

    public function update($request, $id)
    {

        $section = $this->section->findOrFail($id);

        $this->buildObject($request, $section);

        $section->updated_by = Auth::id();

        $section->save();

        return $section;
    }

    private function buildObject($request, $section)
    {
        $section->section_name = $request->section_name;

        $section->classes_id = $request->classes_id;

        $section->organization_id = $request->organization_id;

        $section->status = $request->status;
    }

    public function delete($id)
    {
        $section = $this->section->findOrFail($id);

        $section->delete();
    }

    public function getSectionsWithClassName()
    {

        $orgID = $this->user->getMyOrgIdAttribute();
        $sections = $this->section->select('id', 'section_name', 'classes_id');
        if (!empty($orgID)) {
            $sections = $sections->where('organization_id', $orgID);
        }
        $sections = $sections->get();
        $sectionArray = [];
        foreach ($sections as $section) {
            $sectionArray[$section->id] = $section->classes->name . " " . $section->section_name;
        }
        return $sectionArray;
    }

}
