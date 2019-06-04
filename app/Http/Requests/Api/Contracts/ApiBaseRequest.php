<?php

namespace App\Http\Requests\Api\Contracts;

use Illuminate\Foundation\Http\FormRequest;

abstract class ApiBaseRequest extends FormRequest
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
}
