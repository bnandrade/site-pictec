<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    use HasFactory;

    protected $guard_name = 'web';
    protected $table = 'avisos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'slug',
        'conteudo',
        'data_inicio',
        'data_fim',
        'tipo',
        'published',
        'visibilidade',
        'anexo',
        'imagem',
    ];

    public function scopeOrderByName($query)
    {
        $query->orderBy('titulo');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%'.$search.'%');
            });
        });
    }


}
