<?php

namespace DevbShrestha\Theme\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'type' => 'required|in:' . implode(',', \DevbShrestha\Theme\Models\Menu::TYPES),
            'link' => 'nullable|string',
            'position' => 'nullable|integer',
            'menu_id' => 'nullable|exists:menus,id',
            'status' => 'nullable|in:1',
            'page_id' => 'nullable|exists:c_m_s,id',

        ];
    }
}
