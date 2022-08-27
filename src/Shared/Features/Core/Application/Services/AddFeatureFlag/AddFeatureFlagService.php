<?php

namespace Src\Shared\Features\Core\Application\Services\AddFeatureFlag;

use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;

class AddFeatureFlagService
{
    private FeatureFlagRepository $featureFlagRepository;

    public function __construct(FeatureFlagRepository $featureFlagRepository)
    {
        $this->featureFlagRepository = $featureFlagRepository;
    }


    public function execute(AddFeatureFlagData $addFeatureFlagData): void
    {
        $this->featureFlagRepository->add($addFeatureFlagData->getName(), $addFeatureFlagData->isEnabled());
    }
}
