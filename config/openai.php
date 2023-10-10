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
        'Please act as a comprehensive English dictionary. I will provide you with an English word as input. For translations, use %s. Generate %s example sentences at a %s English proficiency level. Present the results in the specified JSON format: %s'
    ),
    'model' => env('OPEN_AI_MODEL', 'text-davinci-003'),
    'max_tokens' => env('OPEN_AI_MAX_TOKENS', 300),
    'temperature' => env('OPEN_AI_TEMPERATURE', 0.7),
];
