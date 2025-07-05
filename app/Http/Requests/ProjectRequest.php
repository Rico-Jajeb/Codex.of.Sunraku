<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'proj_name' => 'required|string|max:255',
            'proj_description' => 'required|string|max:255',
            'language' => 'required|array|max:255',
            'language.*' => 'string', // if each item is string
            'framework' => 'required|array|max:255',
            'framework.*' => 'string', // if each item is string
            'status' => 'required|string|max:355',
            'github_url' => 'nullable|string|max:6000',
            'live_url' => 'nullable|string|max:6000',
            'highlight' => 'nullable|string|max:6000',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Image validation
        ];
    }
}
