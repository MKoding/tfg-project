<?php

namespace Src\Shared\Features\Core\Domain\Repositories;

use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagAlreadyExistsException;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\FeatureFlag;

interface FeatureFlagRepository
{
    /**
     * @throws FeatureFlagAlreadyExistsException
     */
    public function add(string $name, bool $enabled = false): void;

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function edit(string $name, bool $enabled): void;

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function deleteByName(string $name): void;

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function getByName(string $name): FeatureFlag;

    /**
     * @return FeatureFlag[]
     */
    public function getAll(): array;
}
