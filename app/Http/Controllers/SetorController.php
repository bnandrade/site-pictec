<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorStoreRequest;
use App\Http\Requests\SetorUpdateRequest;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SetorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|setor-listar|setor-editar|setor-criar|setor-deletar']);
    }

    public function index(Request $request)
    {
        $field = 'nome_setor';
        $order = 'ASC';

        if($request->input('order') == 'nameD'){
            $field = 'nome_setor';
            $order = 'DESC';
        }

        return Inertia::render('Setores/Index', [
            'filters' => $request->all('search', 'order'),
            'setores' => Setor::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($setor) => [
                        'id' => $setor->id,
                        'nome_setor' => $setor->nome_setor,
                        'telefone' => $setor->telefone,
                ]),
        ]);
    }

    public function store(SetorStoreRequest $request)
    {
        $data = $request->validated();

        $setorStore = Setor::create($data);

        if($setorStore){
            $request->session()->flash('toast.message', 'Setor cadastrado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar setor!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function update(SetorUpdateRequest $request, Setor $setor)
    {
        $data = $request->validated();

        $setorUpdate = $setor->update($data);

        if($setorUpdate){
            $request->session()->flash('toast.message', 'Setor atualizado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar setor!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function destroy(Request $request, Setor $setor)
    {
        $setorDestroy = $setor->delete();

        if($setorDestroy){
            $request->session()->flash('toast.message', 'Setor excluído com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir setor!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Redirect::route('setores');
    }
}
