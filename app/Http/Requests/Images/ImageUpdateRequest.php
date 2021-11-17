<?php

namespace App\Http\Requests\Images;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url'            => 'required',
            'imageable_id'   => 'required',
            'imageable_type' => 'required',
        ];
    }
}
