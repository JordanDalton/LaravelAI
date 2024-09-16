<?php

namespace JordanDalton\LaravelAI;

use Illuminate\Support\Manager;
use JordanDalton\LaravelAI\AiProviders\Anthropic\AnthropicDriver;

class AiManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config->get('ai.default');
    }

    public function createAnthropicDriver(): AnthropicDriver
    {
        $llm = $this->config->get('ai.llms.claude');
        $provider = $this->config->get('ai.providers.anthropic');

        return new AnthropicDriver($llm, $provider);
    }
}
