<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'video_path'  => 'required',
            'title'       => 'required',
            'body'        => 'required',
            'category_id' => 'required',
        ];
    }
}
