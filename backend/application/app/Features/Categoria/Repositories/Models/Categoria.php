<?php

namespace App\Features\Categoria\Repositories\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['uuid', 'nome', 'descricao', 'status'])]
#[Hidden(['id'])]
#[Table('categorias')]
class Categoria extends Model
{
    protected function casts(): array
    {
        return [];
    }
}
