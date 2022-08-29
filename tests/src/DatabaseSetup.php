<?php

namespace Tests\Src;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\ParallelTesting;

trait DatabaseSetup
{
    protected static bool $migrated = false;

    public function setupDatabase()
    {
        if ($this->isInMemory()) {
            $this->setupInMemoryDatabase();
        } else {
            $this->setupTestDatabase();
        }
    }

    protected function isInMemory(): bool
    {
        return config('database.connections')[config('database.default')]['database'] == ':memory:';
    }

    protected function setupInMemoryDatabase()
    {
        $this->artisan('doctrine:schema:drop --force');
        $this->artisan('doctrine:schema:update --force');
        $this->app[Kernel::class]->setArtisan(null);
        $this->beginDatabaseTransaction();
    }

    protected function setupTestDatabase()
    {
        $this->artisan('doctrine:schema:drop --force');
        $this->artisan('doctrine:schema:update --force');
        $this->app[Kernel::class]->setArtisan(null);
        $this->beginDatabaseTransaction();
    }

    public function beginDatabaseTransaction()
    {
        $databaseName = 'db-' . ParallelTesting::token();
        $database = $this->app->make('db', ['database' => $databaseName]);
        foreach ($this->connectionsToTransact() as $name) {
            $database->connection($name)->beginTransaction();
        }
        $this->beforeApplicationDestroyed(
            function () use ($database) {
                foreach ($this->connectionsToTransact() as $name) {
                    $database->connection($name)->rollBack();
                }
            }
        );
    }

    protected function connectionsToTransact(): array
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact : [null];
    }
}
