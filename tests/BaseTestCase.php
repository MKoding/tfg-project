<?php

namespace Tests;

use Mockery;

class BaseTestCase extends TestCase
{
    protected function tearDown(): void
    {
        if ($container = Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        parent::tearDown();
    }
}
