<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Numero;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $field = 'titulo';
        $order = 'ASC';

        $banner = Banner::orderBy('id', 'desc')->limit('1')->first();
        $bannerImagem = '';
        if($banner){
            $bannerImagem = Storage::url($banner->imagem);
        }

        return Inertia::render('Home', [
            'filters' => $request->all('search', 'order'),
            'banner' => $bannerImagem,
            'projetos' => Projeto::orderByName()
                ->orderBy($field, $order)
                ->filter($request->only('search', 'order'))
                ->paginate(9)
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

    public function detalhes($id)
    {

        return Inertia::render('Detalhes', [
            'projeto' => Projeto::where('id', $id)->get()->map(function ($projeto) {
                return [
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
                ];

            }),

        ]);
    }

}
