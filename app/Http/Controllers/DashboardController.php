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


         $user = Auth::user();
         $user->assignRole('Super.Admin');


        return Inertia::render('Dashboard', [
            'filters' => $request->all('search', 'order'),
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
