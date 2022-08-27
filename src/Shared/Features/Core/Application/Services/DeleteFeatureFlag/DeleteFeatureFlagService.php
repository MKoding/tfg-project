<?php

namespace Src\Shared\Features\Core\Application\Services\DeleteFeatureFlag;

use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;

class DeleteFeatureFlagService
{
    private FeatureFlagRepository $featureFlagRepository;

    public function __construct(FeatureFlagRepository $featureFlagRepository)
    {
        $this->featureFlagRepository = $featureFlagRepository;
    }


    /**
     * @throws FeatureFlagNotFoundException
     */
    public function execute(DeleteFeatureFlagData $deleteFeatureFlagData): void
    {
        $this->featureFlagRepository->deleteByName($deleteFeatureFlagData->getName());
    }
}
