<?php

namespace App\Http\Requests\AdminUser;

use App\Http\Requests\BaseRequest;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateAdminUserRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $adminUser;

    public function __construct(AdminUser $adminUser)
    {
        $this->adminUser = $adminUser;
    }

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
        $adminUser = $this->adminUser->findOrFail($this->route('admin_user'));

        $gender_key = array_keys(config('constants.GENDER_ENUM'));
        $userStatus = array_keys(config('constants.STATUS'));

        return [
            'first_name' => ["required", "min:1", "max:50", "regex:/^(?=.{1,50}$)[a-z]+(?:['.\s][a-z]+)*$/i"],
            'last_name' => ["nullable", "min:1", "max:50", "regex:/^(?=.{1,50}$)[a-z]+(?:['.\s][a-z]+)*$/i"],
            'user_name' => "required",
            'gender' => ['nullable', Rule::in($gender_key)],
            'dob' => 'nullable|date_format:"d F, Y"|before:tomorrow',
            'email_id' => ["bail", "required", "min:6", "max:70", "regex:/^[^_\'.@-][A-Za-z0-9_.\'!-=#$%^+&\*]*(\.[a-zA-Z][a-zA-Z0-9_]*)?[^_]@[a-zA-Z0-9_][a-zA-Z-0-9]*\.[^_][a-zA-Z]+(\.[a-zA-Z]+)?$/", "unique:users,email," . $adminUser->user_id],
            'phone_number' => 'nullable|regex:/^(?!0+$)\d{6,14}$/|unique:admin_users,phone_number,'.$adminUser->id,
            'status' => ['required', Rule::in($userStatus)],
        ];
    }

    public function validateResolved()
    {
        parent::validateResolved();

        if (Request::filled('dob')) {

            $this->setInternalDateFormat('dob');
        }
    }
}
