<?php

namespace App\Http\Requests\Dashboard\category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => '|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
