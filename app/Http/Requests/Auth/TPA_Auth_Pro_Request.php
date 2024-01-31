<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TPA_Auth_Pro_Request extends FormRequest
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
            'password'=>['min:8','max:20','required'],//,'regex:/^[0-9a-zA-Z\-]+$/'
            'email' => ['required',Rule::unique('professionnels')->ignore($this->route()->parameter('professionnel'))]//|regex:/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
        ];
    }
}
