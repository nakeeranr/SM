<?php

namespace App\Http\Requests\Student;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends BaseRequest
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
            'dob' => 'nullable|date_format:"d F, Y"|before:tomorrow',
            'email_id' => ["bail","required", "min:6", "max:70", "unique:users,email", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/"],
            'status' => ['required', Rule::in($userStatus)],
            'section_id'=>'required',
            'organization_id'=>'required',
            'academic_year'=>'required',
            'blood_group'=>'reuired',
            'primary_contact'=>'nullable|regex:/^(?!0+$)\d{6,14}$/|unique:admin_users,phone_number',
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
