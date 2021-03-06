<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjetoStoreRequest;
use App\Http\Requests\ProjetoUpdateRequest;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjetoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|projeto-listar|projeto-editar|projeto-criar|projeto-deletar']);
    }

    public function index(Request $request)
    {
        $field = 'titulo';
        $order = 'ASC';


        return Inertia::render('Projetos/Index', [
            'filters' => $request->all('search', 'order'),
            'projetos' => Projeto::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(20)
                ->withQueryString()
                ->through(fn ($projeto) => [
                    'id' => $projeto->id,
                    'capa' => Storage::url($projeto->capa),
                    'titulo' => $projeto->titulo,
                    'instituicao' => $projeto->instituicao,
                    'cidade' => $projeto->cidade,
                    'coordenador' => $projeto->coordenador,
                    'bolsistas' => $projeto->bolsistas,
                    'ano' => $projeto->ano,
                    'resumo' => $projeto->resumo,
                    'url_video' => $projeto->url_video,
                    'url_foto' => $projeto->url_foto,
                ]),
        ]);
    }


    public function store(ProjetoStoreRequest $request)
    {
        $data = $request->validated();
        if( !empty($data['capa']) ){
            $data['capa'] = $request->capa->store('public/projetos');
        }

        $projetoStore = Projeto::create($data);

        if($projetoStore){
            $request->session()->flash('toast.message', 'Projeto cadastrado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar projeto!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }

    public function update(ProjetoUpdateRequest $request, Projeto $projeto)
    {
        $data = $request->validated();
        $projetoUp = [];

        if( !empty($data['capa']) && $data['capa']){
            $projetoUp['capa'] = $request->capa->store('public/projetos');
        }

        $projetoUp['titulo'] = $data['titulo'];
        $projetoUp['instituicao'] = $data['instituicao'];
        $projetoUp['cidade'] = $data['cidade'];
        $projetoUp['coordenador'] = $data['coordenador'];
        $projetoUp['bolsistas'] = $data['bolsistas'];
        $projetoUp['resumo'] = $data['resumo'];
        $projetoUp['url_video'] = $data['url_video'];
        $projetoUp['url_foto'] = $data['url_foto'];


        $projetoUpdate = $projeto->update($projetoUp);


        if($projetoUpdate){
            $request->session()->flash('toast.message', 'Projeto atualizado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar projeto!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Inertia::location(route('projetos'));
    }

    public function destroy(Request $request, Projeto $projeto)
    {
        $projetoDestroy = $projeto->delete();

        if($projetoDestroy){
            $request->session()->flash('toast.message', 'Projeto exclu??do com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir projeto!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Redirect::route('projetos');
    }
}
