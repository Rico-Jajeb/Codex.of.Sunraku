<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemRequest extends FormRequest
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
            'system_name' => 'required|string|max:255',
            'system_slogan' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'linked' => 'required|string|max:255',
            'github' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'system_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Image validation
            'system_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Image validation

        ];
    }
}
