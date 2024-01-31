<?php

namespace App\Http\Requests\Data;

use Illuminate\Foundation\Http\FormRequest;

class TPA_Mission_Request extends FormRequest
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
            'intitule' =>['required','min:4','max:20'],
            'description' => ['required','min:20','max:150'],
            'fonction' => ['required','min:4','max:20'],
            'debut' => ['required'],
            'fin' => ['required'],
            'remuneration'=>['required'],
            'desc_rem'=>['required','min:4','max:20'],
            'qualification'=>['required','min:4','max:20'],
        ];
    }
}
