<?php

namespace JordanDalton\LaravelAI\AiProviders\Anthropic\Responses;


class ValidateRuleResponse extends CreateMessageResponse
{
    public function decoded()
    {
        return json_decode($this->content('0.text'));
    }

    public function failed(): bool
    {
        return $this->error() || ! $this->decoded()->valid;
    }

    public function errorMessage(): string
    {
        return $this->decoded()->message;
    }
}