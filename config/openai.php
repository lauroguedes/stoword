<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key and Organization
    |--------------------------------------------------------------------------
    |
    | Here you may specify your OpenAI API Key and organization. This will be
    | used to authenticate with the OpenAI API - you can find your API key
    | and organization on your OpenAI dashboard, at https://openai.com.
    */

    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    | Other settings
    */
    'system_completions_prompt' => env(
        'OPENAI_SYSTEM_COMPLETIONS_PROMPT',
        'Create %d sentences in English for the level %s with the word %s separating them with pipe and do not use line break, bookmarks or html tags'
    ),
    'system_chat_prompt' => env(
        'OPENAI_SYSTEM_CHAT_PROMPT',
        'I want you to behave like a complete English dictionary. I will send you three parameters: a word or expression, number of example sentences and English level between A1 to C2. For translations use pt-BR. I need you to give me the result following only the following json structure: {"word":"","translate":"","meaning":{"value":"","translate":""},"word_info":{"plural":"","synonyms":[],"part_of_speech":"","irregular_verbs_list":["simple_present","simple_past","past_participle"],"correct_word":""},"sentences":[{"sentence":"","translate":""}]}'
    ),
    'model' => env('OPEN_AI_MODEL', 'text-davinci-003'),
    'max_tokens' => env('OPEN_AI_MAX_TOKENS', 300),
    'temperature' => env('OPEN_AI_TEMPERATURE', 0.7),
];
