<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use AspectMock\Test as AspectMockTest;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function tearDown()
    {
        AspectMockTest::clean(); // remove all registered test doubles
    }
}
