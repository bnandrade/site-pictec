<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumeroStoreRequest;
use App\Http\Requests\NumeroUpdateRequest;
use App\Models\Numero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class NumeroController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|numero-listar|numero-editar|numero-criar|numero-deletar']);
    }

    public function index(Request $request)
    {
        $field = 'titulo';
        $order = 'ASC';

        return Inertia::render('Numeros/Index', [
            'filters' => $request->all('search', 'order'),
            'numeros' => Numero::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($numero) => [
                    'id' => $numero->id,
                    'imagem' => Storage::url($numero->imagem),
                    'titulo' => $numero->titulo,
                    'valor' => $numero->valor,
                ]),
        ]);
    }

    public function store(NumeroStoreRequest $request)
    {
        $data = $request->validated();

        if( !empty($data['imagem']) ){
            $data['imagem'] = $request->imagem->store('public/numeros');
        }

        $numeroStore = Numero::create($data);

        if($numeroStore){
            $request->session()->flash('toast.message', 'Números cadastrado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar números!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function update(NumeroUpdateRequest $request, Numero $numero)
    {
        $data = $request->validated();

        if( !empty($data['imagem']) ){
            $data['imagem'] = $request->imagem->store('public/numeros');
        }

        $numeroUpdate = $numero->update($data);

        if($numeroUpdate){
            $request->session()->flash('toast.message', 'Números atualizado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar números!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function destroy(Request $request, Numero $numero)
    {
        $numeroDestroy = $numero->delete();

        if($numeroDestroy){
            $request->session()->flash('toast.message', 'Números excluído com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir números!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Redirect::route('numeros');
    }
}
