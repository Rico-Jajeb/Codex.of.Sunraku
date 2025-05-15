<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodexRequest extends FormRequest
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
            'codex_name' => 'required|string|max:255',
            'category_name' => 'nullable|string|max:255', 
            'language' => 'required|array|max:255',
            'language.*' => 'string', // if each item is string
            'framework' => 'required|array|max:255',
            'framework.*' => 'string', // if each item is string
            'tags' => 'required|string|max:355',
            'diffuclt_level' => 'required|string|max:355',
            'content' => 'required|string|max:355',
            'code_snippet' => 'required|string|max:2355',
            'instructions' => 'required|string|max:2355',
            'output' => 'required|string|max:355',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Image validation
        ];
    }
}
