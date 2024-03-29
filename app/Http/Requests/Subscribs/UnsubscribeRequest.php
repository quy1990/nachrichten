<?php

namespace App\Http\Requests\Subscribs;

use Illuminate\Foundation\Http\FormRequest;

class UnsubscribeRequest extends FormRequest
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
        return [
            'subscribable_id'   => 'required|integer',
            'subscribable_type' => 'required|string',
        ];
    }
}
