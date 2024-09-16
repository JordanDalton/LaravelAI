<?php

namespace JordanDalton\LaravelAI\AiProviders\Anthropic\Actions;

use JordanDalton\LaravelAI\AiProviders\Anthropic\AnthropicDriver;
use JordanDalton\LaravelAI\AiProviders\Anthropic\Responses\CreateMessageResponse;

class CreateMessage
{
    public function __construct(public AnthropicDriver $driver, public array $payload = []) {}

    public static function make(AnthropicDriver $driver, array $payload = []): CreateMessage
    {
        return new CreateMessage($driver, $payload);
    }

    public function endpoint(): string
    {
        return "{$this->driver->provider['base_url']}/v1/messages";
    }

    public function model(): string
    {
        $default = data_get($this->driver->llm, 'model');

        return $this->value('model', $default);
    }

    public function value($key, $default = null)
    {
        return data_get($this->payload, $key, $default);
    }

    public function option($key, $default = null)
    {
        return data_get($this->driver->llm, "options.$key", $default);
    }

    public function maxTokens(): int
    {
        return $this->value('max_tokens', $this->option('max_tokens'));
    }

    public function temperature(): float
    {
        return $this->value('temperature', $this->option('temperature'));
    }

    public function system(): ?string
    {
        return $this->value('system');
    }

    public function stream(): bool
    {
        return $this->value('stream', false);
    }

    public function messages(): array
    {
        return $this->value('messages', []);
    }

    public function payload(): array
    {
        $optional = array_filter([
            'system' => $this->system(),
            'stream' => $this->stream(),
        ]);

        $required = [
            'model' => $this->model(),
            'max_tokens' => $this->maxTokens(),
            'temperature' => $this->temperature(),
            'messages' => $this->messages(),
        ];

        return $required + $optional;
    }

    public function execute(): CreateMessageResponse
    {
        $response = $this->driver->post($this->endpoint(), $this->payload());

        return CreateMessageResponse::make($response);
    }
}
