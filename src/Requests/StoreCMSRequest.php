<?php

namespace DevbShrestha\Theme\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCMSRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,webp',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'nullable|in:1',
            'cms_id' => 'nullable|exists:c_m_s,id',
            'slug' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
        ];
    }
}
