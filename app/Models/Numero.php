<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    use HasFactory;

    protected $table = 'numeros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imagem',
        'titulo',
        'valor',
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
                    ->orWhere('valor', 'like', '%'.$search.'%');
            });
        });
    }
}
