<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'ipa' => ['nullable'],
            'translate' => ['required'],
            'meaning' => ['required'],
            'part_of_speech' => ['nullable'],
            'plural' => ['nullable'],
            'synonyms' => ['nullable'],
            'forms' => ['nullable'],
            'sentences' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
