<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'cardapio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_cardapio',
        'almoco_salada',
        'almoco_base',
        'almoco_principal',
        'almoco_guarnicao',
        'almoco_sobremesa',
        'janta_salada',
        'janta_base',
        'janta_principal',
        'janta_guarnicao',
        'janta_sobremesa',
        'published',
    ];

    public function scopeOrderByName($query)
    {
        $query->orderBy('nome_cardapio');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nome_cardapio', 'like', '%'.$search.'%');
            });
        });
    }
}
