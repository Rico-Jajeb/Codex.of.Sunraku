<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AwardRequest extends FormRequest
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
           
            'award_title' => 'required|string|max:255',
            'award_description' => 'required|string|max:355',
            'issuer' => 'required|string|max:255',
            'Date' => 'required|string|max:255',
            'award_url' => 'nullable|string|max:255',
            'highlight' => 'nullable|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240', // Image validation
        ];
    }
}
