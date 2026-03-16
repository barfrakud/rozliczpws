<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        if (empty(config('app.key'))) {
            config(['app.key' => str_repeat('a', 32)]);
        }

        $this->withoutMiddleware(\Lukeraymonddowning\Honey\Http\Middleware\BlockSpammers::class);
    }
}
