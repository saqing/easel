<?php

namespace Canvas\Http\Requests;

use Illuminate\Validation\Rule;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        $email = Auth::guard('canvas')->user()->email;

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'display_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique(CanvasHelper::TABLES['users'])->ignore($email, 'email'),
            ],
        ];
    }
}
