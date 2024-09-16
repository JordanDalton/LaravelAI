<?php

use Illuminate\Support\Facades\Http;

it('should create message using anthropic driver', function(){

    $response = getFixtureAsArray('Anthropic/Messages.Create.Simple.json');

    Http::fake([
        '*' => Http::response($response)
    ]);

    $response = app('ai')->driver('anthropic')->createMessage();

    expect($response->successful())
        ->toBeTrue()
        ->and($response->id())
        ->toBe('msg_123456789')
        ->and($response->model())
        ->toBe('claude-3-5-sonnet-20240620')
        ->and($response->role())
        ->toBe('assistant')
        ->and($response->stopReason())
        ->toBe('end_turn')
        ->and($response->stopSequence())
        ->toBeNull()
        ->and($response->type())
        ->toBe('message')
        ->and($response->usage())
        ->toBeArray();
    //dd($response->json());

});