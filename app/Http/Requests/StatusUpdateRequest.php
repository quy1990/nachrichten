<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusUpdateRequest extends FormRequest
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
