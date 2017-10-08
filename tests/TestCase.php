<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        Schema::enableForeignKeyConstraints();
    }


    protected function signIn($user = null)
    {
        $user = $user?: create(User::class);

        $this->actingAs($user);

        return $this;
    }
}
