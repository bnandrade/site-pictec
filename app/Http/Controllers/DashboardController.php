<?php

namespace App\Http\Controllers;

use App\Models\Aviso;
use App\Models\Cardapio;
use App\Models\Documento;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        /*
         $user = Auth::user();
         $user->assignRole('Super.Admin');
        */

        return Inertia::render('Dashboard', [
            'filters' => $request->all('search', 'order'),
            'avisos' => Aviso::where('published', 1)
                ->get()
                ->transform(function ($aviso) {
                    return [
                        'id' => $aviso->id,
                        'titulo' => $aviso->titulo,
                        'conteudo' => $aviso->conteudo,
                        'published' => $aviso->published,
                        'imagem' => Storage::url($aviso->imagem),
                        'anexo' => Storage::url($aviso->anexo),
                        'created_at' => $aviso->created_at
                    ];
                }),
            'setores' => Setor::orderByName()
                ->filter($request->only('search'))
                ->get()
                ->transform(function ($setor) {
                    return [
                        'id' => $setor->id,
                        'nome_setor' => $setor->nome_setor,
                        'telefone' => $setor->telefone,
                    ];
                }),

        ]);
    }
}
