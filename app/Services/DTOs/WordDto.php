<?php

namespace App\Services\DTOs;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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

    /**
     * @throws Throwable
     * @throws ValidationException
     */
    public static function fromArray(array $data): self
    {
        $instance = new self(
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

        self::validate($instance->toArray());

        return $instance;
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

    /**
     * @throws Throwable
     * @throws ValidationException
     */
    private static function validate(array $content): void
    {
        $data = Validator::make($content, [
            'name' => ['required'],
            'translate' => ['required'],
            'meaning' => ['required', 'array'],
            'sentences' => ['required', 'array'],
            'part_of_speech' => ['nullable'],
            'ipa' => ['nullable'],
            'plural' => ['nullable'],
            'synonyms' => ['nullable'],
            'forms' => ['nullable'],
        ]);

        throw_if($data->fails(), new \Exception('Required properties missing'));
    }
}
