<?php

namespace Modules\Video\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
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
