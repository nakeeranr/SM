<?php

namespace App\Http\Requests\Organization;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreOrganizationRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $curriculum = array_keys(config('constants.CURRICULUM'));
        $status = array_keys(config('constants.STATUS'));

        return [
            'name'=>'required',
            'primary_contact' => 'nullable|regex:/^[0-9]*[-]*[0-9]/|unique:organizations,primary_contact',
            'secondary_contact'=>'nullable|regex:/^[0-9]*[-]*[0-9]/|different:primary_contact|unique:organizations,secondary_contact',
            'website_url'=>'nullable',
            'curriculum'=>['required', Rule::in($curriculum)],
            'status' => ['required', Rule::in($status)],
            'email' => ["bail","required", "min:6", "max:70", "unique:organizations,email", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/"],
            'description'=>'nullable',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'pin_code'=>'required',
            'classes'=>'required',
        ];
    }
}
