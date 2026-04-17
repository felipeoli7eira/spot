<?php

namespace App\Features\Categoria\Providers;

use Illuminate\Support\ServiceProvider;

class CategoriaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        require base_path('app/Features/Categoria/Routes/api.php');
    }
}
