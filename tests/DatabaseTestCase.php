<?php

namespace Tests;

use Tests\Src\DatabaseSetup;

abstract class DatabaseTestCase extends TestCase
{
    use DatabaseSetup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setupDatabase();
    }
}
