<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TPA_Auth_Request extends FormRequest
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
            'name'=> ['min:3','max:20','required'],//'regex:/^[a-zA-Z]+$/',
            'prenom'=> ['min:3','max:20','required'],//'regex:/^[a-zA-Z]+$/',
            'date_naiss'=> [],
            'prop_mission' => ['sometimes'],
            'prop_recue' => ['sometimes'],
            'num_tel'=>['min:6','max:12','required',Rule::unique('particuliers')->ignore($this->route()->parameter('partiulier')),Rule::unique('professionnels')->ignore($this->route()->parameter('professionnel'))],//,'regex:/^[0-9\-]+$/'
            'num_cni'=>['min:14','max:15','required',Rule::unique('particuliers')->ignore($this->route()->parameter('partiulier')),Rule::unique('professionnels')->ignore($this->route()->parameter('professionnel'))],//,'regex:/^[0-9\-]+$/'
            'password'=>['min:8','max:20','required',Rule::unique('particuliers')->ignore($this->route()->parameter('partiulier')),Rule::unique('professionnels')->ignore($this->route()->parameter('professionnel'))],//,'regex:/^[0-9a-zA-Z\-]+$/'
            'email' => ['required',Rule::unique('particuliers')->ignore($this->route()->parameter('partiulier')),Rule::unique('professionnels')->ignore($this->route()->parameter('professionnel'))]//|regex:/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
        ];
    }
}
