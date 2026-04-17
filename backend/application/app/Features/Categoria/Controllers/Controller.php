<?php

namespace App\Features\Categoria\Controllers;

use App\Features\Categoria\Requests\Criar;
use App\Features\Categoria\Services\Service;
use App\Http\Controllers\Controller as BaseController;
use Throwable;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

final class Controller extends BaseController
{
    public function __construct(
        public readonly Service $service,
    ) {}

    public function criar(Criar $dados)
    {
        $dados = $dados->validated();

        try {
            $categoria = $this->service->criar(
                nome: $dados['nome'],
                descricao: $dados['descricao'] ?? null,
                status: $dados['status'] ?? true,
            );
        } catch (Throwable $err) {
            return Response::json(
                $this->err(
                    [
                        "getFile" => $err->getFile(),
                        "getLine" => $err->getLine(),
                    ],
                    $err->getMessage(),
                ),
                HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return Response::json($this->err(
            $categoria,
            "Categoria criada com sucesso.",
        ), HttpFoundationResponse::HTTP_CREATED);
    }

    public function read()
    {
        try {
            $categorias = $this->service->read();
        } catch (Throwable $err) {
            return Response::json(
                $this->err(
                    [
                        "getFile" => $err->getFile(),
                        "getLine" => $err->getLine(),
                    ],
                    $err->getMessage(),
                ),
                HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        return Response::json($this->sucesso(
            $categorias,
            "Categoria listadas com sucesso.",
        ), HttpFoundationResponse::HTTP_OK);
    }
}
