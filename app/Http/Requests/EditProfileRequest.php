<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // O email é unico, portanto para que o usuário consiga editar seu perfil sem ter que alterar o email novamente ou obter mensagem de erro por que o email já foi utilizado, podemos: 
        return [
            'name' => 'required',
            // Sinaliza que o email na tabela usuário como campo único deve ignorar o próprio usuário, e prosseguir com a atualização

            'email' => 'required|unique:users,email,' . auth()->user()->id
        ];
    }
}
