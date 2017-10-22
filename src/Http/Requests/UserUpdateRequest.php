<?php

namespace Canvas\Http\Requests;

use Canvas\Models\User;
use Illuminate\Validation\Rule;
use Canvas\Helpers\CanvasHelper;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $email = User::where('id', $this->route()->user)->pluck('email');

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'display_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique(CanvasHelper::TABLES['users'])->ignore($email->first(), 'email'),
            ],
        ];
    }
}
