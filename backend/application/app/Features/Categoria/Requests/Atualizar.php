<?php

namespace App\Features\Categoria\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

#[StopOnFirstFailure]
#[FailOnUnknownFields]
class Atualizar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'uuid' => $this->route('uuid'),
        ]);
    }

    public function rules(): array
    {
        return [
            'uuid'      => ['required', 'uuid', 'exists:categorias,uuid'],
            'nome'      => ['sometimes', 'string', 'max:255', 'min:3', Rule::unique('categorias', 'nome')->ignore($this->uuid, 'uuid'),],
            'descricao' => ['sometimes', 'string', 'max:255', 'min:3'],
            'status'    => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.uuid' => 'O campo uuid deve ser um UUID válido.',
            'uuid.exists' => 'Categoria informada não existe.',
            'uuid.required' => 'O campo uuid é obrigatório.',

            'nome.string' => 'O nome da categoria deve ser uma string.',
            'nome.max' => 'O nome da categoria deve ter no máximo 255 caracteres.',
            'nome.unique' => 'Categoria já existe.',
            'nome.min' => 'O nome da categoria deve ter no mínimo 3 caracteres.',

            'descricao.string' => 'A descrição da categoria deve ser uma string.',
            'descricao.max' => 'A descrição da categoria deve ter no máximo 255 caracteres.',
            'descricao.min' => 'A descrição da categoria deve ter no mínimo 3 caracteres.',

            'status.nullable' => 'O status da categoria deve ser nulo.',
            'status.boolean' => 'O status da categoria deve ser um booleano.',
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
