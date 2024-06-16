<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|unique:patients,email',
            'tel'=>'required|unique:patients,tel',
            'adresse'=>'nullable',
            'password'=>'required',
            'password_confirm'=>'required',
        ];
    }
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'nom.required'=>'Ce champs est requis',
            'prenom.required'=>'Le prenom est réquis',
            'email.unique'=>'Cette email existe déjà ',
            'tel.unique'=>'Le numéro de téléphone existe déjà ',
            'password.required'=>'Le mots de passes est requis',
            'password_confirm.required'=>'La confirmation du password est requis',
            'email.required'=>'L email est requis ',
            'tel.required'=>'Le numéro de téléphone est requis ',
        ];
    }
}