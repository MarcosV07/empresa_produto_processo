<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreValorDistanciaRequest extends FormRequest
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
            "km_inicial" => "required|numeric",
            "km_final" => "required|numeric",
            "valor" => "required|numeric",
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        if(!empty($data["valor"])) {
            $data["valor"] = moneyToFloat($data["valor"]);
        }

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
