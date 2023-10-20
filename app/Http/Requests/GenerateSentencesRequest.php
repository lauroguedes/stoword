<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateSentencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'prompt' => ['required', 'string', 'min:2', 'max:20'],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }
}
