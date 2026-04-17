<?php

namespace App\Features\Categoria\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

#[StopOnFirstFailure]
#[FailOnUnknownFields]
class Listar extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $campos = [];

        if (request()->query('uuid')) {
            $campos['uuid'] = request()->query('uuid');
        }

        return $campos;
    }

    public function rules(): array
    {
        return [
            'uuid' => ['nullable', 'uuid', 'exists:categorias,uuid']
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.uuid' => 'O campo uuid deve ser um UUID válido.',
            'uuid.exists' => 'Categoria informada não existe.'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'err' => true,
            'msg' => 'Erro de validação de cadastro de categoria.',
            'data' => $validator->errors()->all(),
        ], Response::HTTP_BAD_REQUEST));
    }
}
