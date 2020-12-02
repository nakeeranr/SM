<?php

namespace App\Http\Requests\Section;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends BaseRequest
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
        $userStatus = array_keys(config('constants.STATUS'));
        return [
            'section_name' => ["required"],
            'classes_id' =>"required",
            'organization_id' =>"required",
            'status' => ['required', Rule::in($userStatus)]
        ];
    }

}
