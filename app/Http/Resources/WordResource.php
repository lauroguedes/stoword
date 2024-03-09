<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Word */
class WordResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'name' => $this->name,
            'ipa' => $this->ipa,
            'translate' => $this->translate,
            'meaning' => $this->meaning,
            'part_of_speech' => $this->part_of_speech,
            'plural' => $this->plural,
            'synonyms' => $this->synonyms,
            'forms' => $this->forms,
            'sentences' => $this->sentences,
        ];
    }
}
