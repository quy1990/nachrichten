<?php

namespace Modules\Status\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

Abstract class AbstractStatusRequest  extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
