<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardapioStoreRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'cardapioStore';

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
            'nome_cardapio' => 'required|string',
            'almoco_salada' => 'required|string',
            'almoco_base' => 'required|string',
            'almoco_principal' => 'required|string',
            'almoco_guarnicao' => 'required|string',
            'almoco_sobremesa' => 'required|string',
            'janta_salada' => 'required|string',
            'janta_base' => 'required|string',
            'janta_principal' => 'required|string',
            'janta_guarnicao' => 'required|string',
            'janta_sobremesa' => 'required|string',
            'published' => '',
        ];
    }
}
