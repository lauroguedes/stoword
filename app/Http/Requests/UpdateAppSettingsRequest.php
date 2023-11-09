<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppSettingsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'level' => 'required|in:A1,A2,B1,B2,C1,C2',
            'qtd_sentences' => 'required|integer|min:1|max:3',
            'native_language' => 'required|in:pt-br,pt,es,fr,de,it,ru,ja,ko,zh',
        ];
    }
}
