<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoUpdateRequest extends FormRequest
{

    /**
     * The key to be used for the view error bag.
     *
     * @var string
     */
    protected $errorBag = 'projetoUpdate';
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
            'capa' => '',
            'titulo' => 'required|string',
            'instituicao' => 'required|string',
            'cidade' => 'required|string',
            'coordenador' => 'required|string',
            'bolsistas' => 'string',
            'resumo' => 'required|string',
            'url_video' => 'string',
            'url_foto' => 'string',
        ];
    }
}
