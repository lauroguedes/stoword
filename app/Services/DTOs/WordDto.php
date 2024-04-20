<?php

namespace App\Services\DTOs;

use Throwable;

class WordDto
{
    public function __construct(
        public ?string $name,
        public ?string $translate,
        public ?array $meaning,
        public ?array $sentences,
        public ?string $part_of_speech = null,
        public ?string $ipa = null,
        public ?string $plural = null,
        public ?string $synonyms = null,
        public ?string $forms = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['word'] ?: null,
            $data['translate'] ?: null,
            $data['meaning'] ?: null,
            $data['sentences'] ?: null,
            $data['part_of_speech'] ?: null,
            $data['ipa_word'] ?: null,
            $data['plural'] ?: null,
            $data['synonyms'] ?: null,
            $data['word_forms'] ?: null,
        );
    }

    /**
     * @throws Throwable
     */
    public static function fromJson(string $json): self
    {
        throw_if(
            !str()->of($json)->isJson(),
            new \Exception('String json invalid')
        );

        return self::fromArray(json_decode($json, true));
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'translate' => $this->translate,
            'meaning' => $this->meaning,
            'sentences' => $this->sentences,
            'part_of_speech' => $this->part_of_speech,
            'ipa' => $this->ipa,
            'plural' => $this->plural,
            'synonyms' => $this->synonyms,
            'forms' => $this->forms,
        ];
    }
}
