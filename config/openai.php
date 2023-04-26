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
    'system_prompt' => env('OPENAI_SYSTEM_PROMPT', 'You are an English Teacher'),
    'completion_model' => env('OPENAI_COMPLETION_MODEL', 'text-davinci-003'),
    'chat_model' => env('OPENAI_CHAT_MODEL', 'gpt-3.5-turbo'),
];
