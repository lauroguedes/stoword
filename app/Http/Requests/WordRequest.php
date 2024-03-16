<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'translate' => ['required'],
            'meaning' => ['required', 'array'],
            'sentences' => ['required', 'array'],
            'part_of_speech' => ['nullable'],
            'ipa' => ['nullable'],
            'plural' => ['nullable'],
            'synonyms' => ['nullable'],
            'forms' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
