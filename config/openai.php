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
        'You are an expert English Teacher. Please create sentences in English with the same word or expression, the number of sentences, and the English level that I send you as params. Remove the line break, bookmarks, html tags, and accentuations, after that separate them with a pipe'
    ),
    'model' => env('OPEN_AI_MODEL', 'text-davinci-003'),
    'max_tokens' => env('OPEN_AI_MAX_TOKENS', 200),
    'temperature' => env('OPEN_AI_TEMPERATURE', 0.7),
];
