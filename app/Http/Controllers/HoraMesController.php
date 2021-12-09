<?php

namespace App\Http\Controllers;

use App\Models\HoraMes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HoraMesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Super.Admin']);
    }


    public function index(Request $request)
    {

        return Inertia::render('HoraMes/Index', [
            'hora_mes' => HoraMes::orderByName()
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($hora) => [
                    'id' => $hora->id,
                    'titulo' => $hora->titulo,
                    'quantidade' => $hora->quantidade,
                ]),
        ]);
    }
}
