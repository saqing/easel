<?php

namespace Canvas\Http\Requests;

use Canvas\Helpers\CanvasHelper;
use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest
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
            'tag' => 'required|unique:'.CanvasHelper::TABLES['tags'].',tag',
            'title' => 'required',
            'subtitle' => 'required',
        ];
    }
}
