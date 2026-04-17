<?php

namespace App\Features\Produto\Repositories\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use App\Features\Categoria\Repositories\Models\Categoria;

#[Fillable(['uuid', 'nome', 'descricao', 'preco', 'categoria_id'])]
#[Hidden(['id'])]
#[Table('produtos')]
class Produto extends Model
{
    protected function casts(): array
    {
        return [];
    }

    public function categoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'categoria_id',
            'id',
            'uuid',
            true
        );
    }
}
