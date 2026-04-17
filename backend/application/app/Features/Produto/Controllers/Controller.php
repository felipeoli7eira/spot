<?php

namespace App\Features\Produto\Controllers;

use App\Features\Produto\Requests\Criar;
// use App\Features\Produto\Requests\Listar;
// use App\Features\Produto\Requests\Deletar;
// use App\Features\Produto\Requests\Atualizar;

use App\Features\Produto\Services\Service;

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

        $categoriaUuid = $dados['categoria'];

        unset($dados['categoria']);

        try {
            $produto = $this->service->criar($categoriaUuid, $dados);
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
            $produto,
            "Produto criado com sucesso.",
        ), HttpFoundationResponse::HTTP_CREATED);
    }

    // public function listar(Listar $dados)
    // {
    //     try {
    //         $categorias = $this->service->listar(
    //             $dados->validated()
    //         );
    //     } catch (Throwable $err) {
    //         return Response::json(
    //             $this->err(
    //                 [
    //                     "getFile" => $err->getFile(),
    //                     "getLine" => $err->getLine(),
    //                 ],
    //                 $err->getMessage(),
    //             ),
    //             HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
    //         );
    //     }

    //     return Response::json($this->sucesso(
    //         $categorias,
    //         "Categoria listadas com sucesso.",
    //     ), HttpFoundationResponse::HTTP_OK);
    // }

    // public function deletar(Deletar $dados)
    // {
    //     try {
    //         $this->service->deletar($dados->validated('uuid'));
    //     } catch (Throwable $err) {
    //         return Response::json(
    //             $this->err(
    //                 [
    //                     "getFile" => $err->getFile(),
    //                     "getLine" => $err->getLine(),
    //                 ],
    //                 $err->getMessage(),
    //             ),
    //             HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
    //         );
    //     }

    //     return Response::noContent();
    // }

    // public function atualizar(Atualizar $dados)
    // {
    //     try {
    //         $dados = $dados->validated();

    //         $uuid = $dados['uuid'];

    //         unset($dados['uuid']);;

    //         $categoria = $this->service->atualizar(
    //             $uuid,
    //             $dados
    //         );
    //     } catch (Throwable $err) {
    //         return Response::json(
    //             $this->err(
    //                 [
    //                     "getFile" => $err->getFile(),
    //                     "getLine" => $err->getLine(),
    //                 ],
    //                 $err->getMessage(),
    //             ),
    //             HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR,
    //         );
    //     }

    //     return Response::json($this->sucesso(
    //         $categoria,
    //         "Dados da categoria atualizados com sucesso.",
    //     ), HttpFoundationResponse::HTTP_OK);
    // }
}
