<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorUpdateRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'setorUpdate';


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
            'nome_setor' => 'required|string',
            'telefone' => 'required|string',
        ];
    }
}
