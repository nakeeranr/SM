<?php

namespace App\Http\Requests\Teacher;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends BaseRequest
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

        $gender_key = array_keys(config('constants.GENDER_ENUM'));
        $userStatus = array_keys(config('constants.STATUS'));

        return [
            'first_name' => ["required", "min:1", "max:50", "regex:/^(?=.{1,50}$)[a-z]+(?:['.\s][a-z]+)*$/i"],
            'last_name' => ["nullable", "min:1", "max:50", "regex:/^(?=.{1,50}$)[a-z]+(?:['.\s][a-z]+)*$/i"],
            'user_name' =>"required",
            'gender' => ['nullable', Rule::in($gender_key)],
            'dob' => 'nullable|before:tomorrow',
            'email_id' => ["bail","required", "min:6", "max:70", "unique:users,email", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/"],
            'phone_number' => 'nullable|regex:/^(?!0+$)\d{6,14}$/|unique:admin_users,phone_number',
            'status' => ['required', Rule::in($userStatus)],
            'address'=>'nullable',
            'city'=>'nullable',
            'state'=>'nullable',
            'country'=>'nullable',
            'pin_code'=>'nullable',
            'qualification'=>'nullable',
            'certification'=>'nullable',
            'experience_details'=>'nullable',
            'subject'=>'required',
            'organization_id'=>'required',
            'sections'=>'required'
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();

        if(Request::filled('dob')){

            $this->setInternalDateFormat('dob');
        }
    }
}
