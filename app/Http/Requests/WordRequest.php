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
            'meaning' => ['required'],
            'sentences' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
