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
            'CodexName' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'framework' => 'required|string|max:355',
            'tag' => 'required|string|max:355',
            'level' => 'required|string|max:355',
            'content' => 'required|string|max:355',
            'code' => 'required|string|max:2355',
            'instruction' => 'required|string|max:2355',
            'output' => 'required|string|max:355',
            'img' => 'required|string|max:355',
        ];
    }
}
