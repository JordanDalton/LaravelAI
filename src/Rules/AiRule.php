<?php

namespace JordanDalton\LaravelAI\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use JordanDalton\LaravelAI\AiProviders\Anthropic\AnthropicDriver;

class AiRule implements ValidationRule
{
    protected AnthropicDriver $driver;

    public function __construct(public string $prompt, public string $provider)
    {
        $this->driver = app('ai')->driver($provider);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string = null): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validation = $this->driver->validateInput($value, $this->prompt);

        if ($validation->failed()) {
            $fail(":attribute: {$validation->errorMessage()}");
        }
    }
}
