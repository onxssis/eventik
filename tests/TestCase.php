<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function signIn($user = null)
    {
        $user = $user ?: factory(\App\User::class)->create();

        $this->actingAs($user);

        return $this;
    }
}
