<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();

        $this->registerRegexpMethodForSqlite();
    }

    public function signIn($user = null)
    {
        $user = $user ? : factory(\App\User::class)->create();

        $this->actingAs($user);

        return $this;
    }

    public function registerRegexpMethodForSqlite()
    {
        DB::connection()->getPdo()->sqliteCreateFunction('REGEXP', function ($pattern, $value) {
            mb_regex_encoding('UTF-8');
            return (false !== mb_ereg("/$pattern/", $value)) ? 1 : 0;
        });
    }
}
