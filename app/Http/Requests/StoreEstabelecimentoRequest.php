<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstabelecimentoRequest extends FormRequest
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
        
        $rules = [
            "nome" => "required",
            "tipo_pessoa_id" => "required|numeric|exists:tipo_pessoas,id",
            "numero_documento" => "required|min:14|max:18",
            "categoria_id" => "required|numeric|exists:categorias,id",
            "email" => "required|email:rfc,dns",
            "cep" => "required|formato_cep",
            "logradouro" => "required",
            "bairro" => "required",
            "estado" => "required",
            "cidade" => "required",
            "numero" => "required",
            "situacao_estabelecimento_id" => "required|numeric|exists:situacao_estabelecimentos,id"
        ];
        
        $request = $this->request->all();

        if(isset($request["tipo_pessoa_id"]) && $request["tipo_pessoa_id"] == 1) {
            $rules["numero_documento"] .= "|cpf"; 
        } else {
            $rules["numero_documento"] .= "|cnpj"; 
        }

        // A senha é requerida somente no cadastro
        if(isset($request["id"]) && empty($request["id"])) {
            $rules["senha"] = "required";
        }

        return $rules;
    }

    public function messages() {

        $messages = [
            "cep.formato_cep" => "CEP no formato inválido."
        ];

        $request = $this->request->all();
        
        if(isset($request["tipo_pessoa_id"]) && $request["tipo_pessoa_id"] == 1) {
            $messages["numero_documento.cpf"] = "O CPF informado está inválido.";
        } else {
            $messages["numero_documento.cnpj"] = "O CNPJ informado está inválido.";
        }

        return $messages;
    }
}
