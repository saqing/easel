<?php

namespace Canvas\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
        $this->sanitiseInput();

        return [
            'blog_title' => 'required',
            'blog_subtitle' => 'required',
        ];
    }

    /**
     * Sanitise the input from the request.
     * In this case, the input is type casted where required.
     *
     * @return void
     */
    public function sanitiseInput()
    {
        $source = $this->getInputSource();

        $data = $source->all();

        $data['post_is_published_default'] = filter_var(
            $this->post_is_published_default,
            FILTER_VALIDATE_BOOLEAN
        );

        $source->replace($data);
    }
}
