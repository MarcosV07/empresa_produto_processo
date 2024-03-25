<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
        return [
            "estabelecimento_id" => "required",
            "produto_id" => "required",
            "cliente_id" => "required",
            "status_pedido_id" => "required",
            "valor_pedido" => "required"
        ];
    }
}
