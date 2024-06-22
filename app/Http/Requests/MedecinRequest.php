<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedecinRequest extends FormRequest
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
            'email'=>'nullable|email|unique:medecins,email',
            'tel'=>'required|unique:medecins,tel',
            'adresse'=>'nullable',
            'profil'=>'nullable|image:png,jpg,jpeg',

        ];
    }



    public function messages():array {

        return [
            'nom.required'=>'Le nom est requis dans l ajout du medecin ',
            'prenom.required'=>'Le prenom est requis dans l ajout du medecin ',
            'tel.required'=>'Le téléhone est requis dans l ajout du medecin ',
            'profil.image'=>'Le type de l image n est pas pris en compte on veut jpg,png,jpeg  ',
            'email.unique'=>'L email existe déjà dans la base de données  ',
            'email.email'=>'L adresse email n est pas correct  ',
            'nom.unique'=>'Le numéro de téléphone doit etre unique  ',
            'tel.unique'=>'Le numéro existe déjà dans la dase de données   ',
        ];
    }
}
