<?php

return [

    'default' => env('AI_DRIVER', 'anthropic'),

    'llms' => [
        'claude' => [
            'driver' => 'anthropic',
            'model' => env('ANTHROPIC_MODEL', 'claude-3-5-sonnet-20240620'),
            'api_key' => env('ANTHROPIC_API_KEY'),
            'version' => env('ANTHROPIC_API_VERSION', '2023-06-01'),
            'options' => [
                'max_tokens' => env('ANTHROPIC_MAX_TOKENS', 1000),
                'temperature' => env('ANTHROPIC_TEMPERATURE', 0.7),
            ],
        ],
    ],

    'providers' => [

        'anthropic' => [
            'driver' => 'anthropic',
            'base_url' => env('ANTHROPIC_BASE_URL', 'https://api.anthropic.com'),
        ],

        'openai' => [
            'driver' => 'openai',
            'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
        ],
    ],
];
