<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaboradores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'colaborador_nome',
        'colaborador_id',
        'colaborador_drt',
    ];

    public function scopeOrderByName($query)
    {
        $query->orderBy('colaborador_nome');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('colaborador_nome', 'like', '%'.$search.'%')
                    ->orWhere('colaborador_id', 'like', '%'.$search.'%')
                    ->orWhere('colaborador_drt', 'like', '%'.$search.'%');
            });
        });
    }
}
