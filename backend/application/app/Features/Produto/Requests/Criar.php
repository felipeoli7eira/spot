<?php

namespace App\Features\Produto\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;
use \Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

#[StopOnFirstFailure]
#[FailOnUnknownFields]
class Criar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome'      => ['required', 'string', 'max:255', 'unique:produtos,nome', 'min:3'],
            'descricao' => ['required', 'string', 'max:255', 'min:3'],
            'preco'     => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
            'categoria' => ['required', 'uuid', 'exists:categorias,uuid'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'nome.unique' => 'Produto com esse nome já existe.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',

            'descricao.required' => 'O campo descricao é obrigatório.',
            'descricao.string' => 'O campo descricao deve ser uma string.',
            'descricao.max' => 'O campo descricao deve ter no máximo 255 caracteres.',
            'descricao.min' => 'O campo descricao deve ter no mínimo 3 caracteres.',

            'preco.decimal' => 'O campo preco deve ser um número decimal.',
            'preco.min' => 'O campo preco deve ser maior ou igual a 0.',

            'categoria.required' => 'O campo categoria é obrigatório.',
            'categoria.uuid' => 'O campo categoria deve ser um UUID válido.',
            'categoria.exists' => 'Categoria informada não existe.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'err' => true,
            'msg' => 'Erro de validação na feature de produtos.',
            'data' => $validator->errors()->all(),
        ], Response::HTTP_BAD_REQUEST));
    }
}
