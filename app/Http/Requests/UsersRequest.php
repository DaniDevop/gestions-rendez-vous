<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name'=>'required',
            'prenom'=>'required',
            'profil'=>'nullable|image:png,jpeg,jpg',
            'role'=>'required',
            'password'=>'required|min:4',
            'password_confirm'=>'required|min:4',
            'email'=>'nullable|unique:users,email',

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
           'name.required'=>'Le nom est requis',
           'prenom.unique'=>'Le prenom est requis',
           'role.required'=>'Le role est requis',
           'password.min'=>'Le mot de passe doit avoir aumoins 4 caractère',
           'password_confirm.required'=>'Le mot  de passe de confirmation doit avoir aumoins 4 caractères',
           'email.unique'=>'L email existe déjà dans la base de donnée 🛑',

        ];
    }
}
