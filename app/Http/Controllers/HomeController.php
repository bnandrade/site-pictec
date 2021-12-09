<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Home', [
            'filters' => $request->all('search', 'order'),
        ]);
    }

    public function quem_somos(Request $request)
    {
        return Inertia::render('QuemSomos', [
            'filters' => $request->all('search', 'order'),
        ]);
    }

    public function etiquetas_escolares(Request $request)
    {
        return Inertia::render('EtiquetasEscolares', [
            'filters' => $request->all('search', 'order'),
        ]);
    }

    public function nossos_links()
    {
        return Inertia::render('NossosLinks', []);
    }
}
