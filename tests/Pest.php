<?php

use JordanDalton\LaravelAI\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);


function getFixture($name): string
{
    return file_get_contents(__DIR__ . '/Fixtures/' . $name);
}

function getFixtureAsArray($name): array
{
    return json_decode(getFixture($name), true);
}