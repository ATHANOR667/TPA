<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Experience_Request extends FormRequest
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
            'fonction' => 'required|string|max:255',
            'debut' => 'required|date',
            'fin' => 'nullable|date',
            'remuneration' => 'nullable|numeric',
            'desc_rem' => 'nullable|string',
            'qualification' => 'nullable|string|max:255',
            'professionel_id' => 'required|exists:professionnels,id',
        ];
    }
}
