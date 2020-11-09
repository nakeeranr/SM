<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    protected function setInternalDateFormat($field)
    {
        $this->request->set($field, \DateTime::createFromFormat(config('constants.date_format.input'), $this->{$field})->format(config('constants.date_format.internal')));
    }

}
?>