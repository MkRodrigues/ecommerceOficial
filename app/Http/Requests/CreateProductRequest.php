<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Podemos colocar as regras de perfis de usuário, podendo permitir ou não acessos por usuários configurados
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255',
            'image' => 'required|image',
            'description' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'stock' => 'required',
            'category_id' => 'required'
        ];
    }
}
