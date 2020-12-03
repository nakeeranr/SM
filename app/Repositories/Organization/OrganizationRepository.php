<?php

namespace App\Repositories\Organization;

use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class OrganizationRepository implements OrganizationInterface
{
    private $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function getAll()
    {
        return $this->organization->with('classes')->get();
    }

    public function find($id)
    {
        return $this->organization->with('classes')->findOrFail($id);
    }

    public function create($request)
    {
        $organization = $this->organization;

        $this->buildObject($request, $organization);

        $organization->created_by = Auth::id();
        $organization->updated_by = Auth::id();
        $organization->save();

        $organization->classes()->sync($request->get('classes'));

        return $organization;
    }

    public function update($request, $id)
    {

        $organization = $this->organization->findorFail($id);

        $this->buildObject($request, $organization);

        $organization->updated_by = Auth::id();
        
        $organization->save();

        $organization->classes()->sync($request->get('classes'));

        return $organization;
    }

    private function buildObject($request, $organization)
    {

        $organization->name = $request->get('name');

        $organization->primary_contact = $request->get('primary_contact');

        $organization->secondary_contact = $request->get('secondary_contact');

        $organization->website_url = $request->get('website_url');

        $organization->email = $request->get('email');

        $organization->curriculum = $request->get('curriculum');

        $organization->status = $request->get('status');

        $organization->description = $request->get('description');

        $organization->address = $request->get('address');

        $organization->city = $request->get('city');

        $organization->state = $request->get('state');

        $organization->country = $request->get('country');

        $organization->pin_code = $request->get('pin_code');
    }

    public function getOrgWithClass($id)
    {
        return $this->organization->with('orgClass')->findOrFail($id);
    }

    public function delete($id)
    {
        $organization = $this->organization->findorFail($id);

        $organization->classes()->detach();

        $organization->delete();
    }

}
