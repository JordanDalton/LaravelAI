<?php

namespace JordanDalton\LaravelAI\AiProviders\Anthropic\Responses;

use Illuminate\Http\Client\Response;

class CreateMessageResponse implements AnthropicResponse
{
    public function __construct(public Response $response)
    {
        //
    }

    public static function make(Response $response): AnthropicResponse
    {
        return new static($response);
    }

    public function response(): Response
    {
        return $this->response;
    }

    public function successful(): bool
    {
        return $this->response->successful();
    }

    public function json($key = null, $default = null): mixed
    {
        return $this->response->json($key, $default);
    }

    public function id(): string
    {
        return $this->json('id');
    }

    public function model(): string
    {
        return $this->json('model');
    }

    public function content(string $key): array|string
    {
        return $this->response->json($key ? "content.$key" : 'content', []);
    }

    public function role(): string
    {
        return $this->json('role');
    }

    public function stopReason(): string
    {
        return $this->json('stop_reason');
    }

    public function stopSequence(): ?string
    {
        return $this->json('stop_sequence');
    }

    public function type(): string
    {
        return $this->json('type');
    }

    public function usage(): array
    {
        return $this->json('usage', []);
    }

    public function error(): bool
    {
        return $this->type() === 'error';
    }

    public function errorMessage(): ?string
    {
        return $this->error() ? 'AI Provider Error' : null;
    }
}
