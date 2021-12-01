<?php

namespace DevbShrestha\Theme\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Theme;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required|string|max:30|unique:roles,name,' . $this->role->id . ',id',
            'permissions.*' => 'nullable|in:' . implode(',', Theme::getPermission()),
        ];
    }
}
