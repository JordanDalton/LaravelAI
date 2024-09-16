<?php

it('resolves default driver out of container', function () {

    expect(app('ai')->getDefaultDriver())->toBe('anthropic');

});
