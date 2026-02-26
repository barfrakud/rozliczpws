<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function test_home_page_returns_success_status(): void
    {
        $this->get(route('home'))->assertOk();
    }
}
