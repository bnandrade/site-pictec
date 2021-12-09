<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvisoStoreRequest;
use App\Http\Requests\AvisoUpdateRequest;
use App\Models\Aviso;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class AvisoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin|aviso-listar|aviso-editar|aviso-criar|aviso-deletar']);
    }

    public function index(Request $request)
    {
        $field = 'titulo';
        $order = 'ASC';

        if($request->input('order') == 'nameD'){
            $field = 'titulo';
            $order = 'DESC';
        }

        return Inertia::render('Avisos/Index', [
            'filters' => $request->all('search', 'order'),
            'setores' => $setores = Setor::all(),
            'avisos' => Aviso::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($aviso) => [
                        'id' => $aviso->id,
                        'titulo' => $aviso->titulo,
                        'conteudo' => $aviso->conteudo,
                        'published' => $aviso->published,
                        'imagem' => Storage::url($aviso->imagem),
                        'anexo' => Storage::url($aviso->anexo),
                        'created_at' => $aviso->created_at
                ]),
        ]);
    }

    public function store(AvisoStoreRequest $request)
    {
        $data = $request->validated();

        if( !empty($data['anexo']) ){
            $data['anexo'] = $request->anexo->store('public/avisos');
        }

        if( !empty($data['imagem']) ){
            $data['imagem'] = $request->imagem->store('public/avisos');
        }

        $data['slug'] = Str::slug($data['titulo'], '-');

        $verifySlug = Aviso::where('slug', $data['slug'])->count();

        if($verifySlug > 0)
            $data['slug'] = Str::slug($data['slug'].'-'.date('H:i:s'));


        $avisoStore = Aviso::create($data);


        if($avisoStore){
            $request->session()->flash('toast.message', 'Aviso cadastrado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao cadastrar aviso!');
            $request->session()->flash('toast.style', 'danger');
        }

        return back(303);
    }


    public function update(AvisoUpdateRequest $request, Aviso $aviso)
    {
        $data = $request->validated();

        $avisoUp = [];

        if( !empty($data['anexo']) ){
            $avisoUp['anexo'] = $request->anexo->store('public/avisos');
        }

        if( !empty($data['imagem']) ){
            $avisoUp['imagem'] = $request->imagem->store('public/avisos');
        }

        $avisoUp['titulo'] = $data['titulo'];
        $avisoUp['conteudo'] = $data['conteudo'];
        $avisoUp['published'] = $data['published'];

        $avisoUpdate = $aviso->update($avisoUp);

        if($avisoUpdate){
            $request->session()->flash('toast.message', 'Aviso atualizado com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao atualizar aviso!');
            $request->session()->flash('toast.style', 'danger');
        }

        //return back(303);
        return Inertia::location(route('avisos'));

    }

    public function destroy(Request $request, Aviso $aviso)
    {
        $avisoDestroy = $aviso->delete();

        if($avisoDestroy){
            $request->session()->flash('toast.message', 'Aviso excluído com sucesso!');
            $request->session()->flash('toast.style', 'success');
        }else{
            $request->session()->flash('toast.message', 'Ops! Erro ao excluir aviso!');
            $request->session()->flash('toast.style', 'danger');
        }

        return Inertia::location(route('avisos'));
    }

    /*
    public function update(Request $request, Aviso $aviso)
    {
        if(Auth::user()->can('editar-aviso')) {

            $request->validate([
                'title' => 'required|max:140',
                'type' => 'required',
                'image' => 'image',
            ]);

            $data = [];

            $attach = 'sem-anexo';
            if(!empty($request->file('attach'))){
                $data['attach'] = $request->attach->store('public/avisos');
            }

            if(!empty($request->file('image'))){
                $data['image'] = $request->image->store('public/avisos');
            }

            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;
            $data['title'] = $request->title;
            $data['content'] = $request->content;
            $data['type'] = $request->type;
            $data['published'] = $request->published;

            $aviso->update($data);

            session()->flash('success', 'Aviso atualizado com sucesso.');

            return Redirect::back();
        }else{
            abort('403');
        }
    }
    */
}
