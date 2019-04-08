<?php

namespace contenedor\Http\Requests;

use contenedor\Http\Requests\Request;

class DistanciaFormRequest extends Request
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
            'chipid' => 'required',
            'fecha' => 'required',
            'distancia' =>'max:4';
        ];
    }
}
