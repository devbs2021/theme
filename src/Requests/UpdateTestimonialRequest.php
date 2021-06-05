<?php

namespace Devbs\Theme\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
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

            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,gif',
            'message' => 'required|string|max:2000',
            'introduction' => 'nullable|string|max:500',
            'status' => 'nullable|in:1',
            'position'=>'nullable|integer'

        ];
    }
}
