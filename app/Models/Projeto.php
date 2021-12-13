<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'instituicao',
        'cidade',
        'coordenador',
        'resumo',
        'url_video',
        'url_foto',
        'ano',
        'bolsistas'
    ];

    public function scopeOrderByName($query)
    {
        $query->orderBy('titulo');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%'.$search.'%')
                    ->orWhere('instituicao', 'like', '%'.$search.'%')
                    ->orWhere('coordenador', 'like', '%'.$search.'%')
                    ->orWhere('cidade', 'like', '%'.$search.'%');
            });
        });
    }
}
