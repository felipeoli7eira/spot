<?php

namespace App\Features\Produto\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\Attributes\FailOnUnknownFields;
use Illuminate\Foundation\Http\Attributes\StopOnFirstFailure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

#[StopOnFirstFailure]
#[FailOnUnknownFields]
class Deletar extends FormRequest
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
            'uuid' => ['required', 'uuid', 'exists:produtos,uuid']
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.uuid'     => 'O campo uuid deve ser um UUID válido.',
            'uuid.exists'   => 'Produto informada não existe.',
            'uuid.required' => 'O campo uuid é obrigatório.'
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
