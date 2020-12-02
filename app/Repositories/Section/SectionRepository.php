<?php

namespace App\Repositories\Section;

use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class SectionRepository implements SectionInterface
{

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function getAll(){
        return $this->section->all();
    }

    public function find($id){
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
    
    public function update($request,$id){

    }

    private function buildObject($request, $section)
    {
        $section->section_name= $request->section_name;

        $section->classes_id= $request->classes_id;

        $section->organization_id= $request->organization_id;

        $section->status= $request->status;
    }

    public function delete($id){
        
    }

}