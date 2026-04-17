<?php

namespace App\Features\Categoria\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'      => ['required', 'string', 'max:255', 'unique:categorias,nome', 'min:3'],
            'descricao' => ['required', 'string', 'max:255', 'min:3'],
            'status'    => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'nome.unique' => 'O campo nome já existe.',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',

            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
            'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres.',

            'status.boolean' => 'O campo status deve ser um booleano.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'err' => true,
            'msg' => 'Erro de validação na feature de categoria.',
            'data' => $validator->errors()->all(),
        ], Response::HTTP_BAD_REQUEST));
    }
}
