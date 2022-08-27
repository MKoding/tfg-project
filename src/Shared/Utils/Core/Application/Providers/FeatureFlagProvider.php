<?php

namespace Src\Shared\Utils\Core\Application\Providers;

use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\FeatureFlag;
use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;

class FeatureFlagProvider
{
    private FeatureFlagRepository $featureFlagRepository;

    public function __construct(FeatureFlagRepository $featureFlagRepository)
    {
        $this->featureFlagRepository = $featureFlagRepository;
    }

    public function useFeature(string $name): bool
    {
        try {
            return $this->featureFlagRepository->getByName($name)->isEnabled();
        } catch (FeatureFlagNotFoundException) {
            return false;
        }
    }

    /**
     * @return FeatureFlag[]
     */
    public function getFeatureFlags(): array
    {
        return $this->featureFlagRepository->getAll();
    }
}
