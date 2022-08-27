<?php

namespace Src\Shared\Features\Core\Application\Services\EditFeatureFlag;

use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;

class EditFeatureFlagService
{
    private FeatureFlagRepository $featureFlagRepository;

    public function __construct(FeatureFlagRepository $featureFlagRepository)
    {
        $this->featureFlagRepository = $featureFlagRepository;
    }


    /**
     * @throws FeatureFlagNotFoundException
     */
    public function execute(EditFeatureFlagData $editFeatureFlagData): void
    {
        $this->featureFlagRepository->edit($editFeatureFlagData->getName(), $editFeatureFlagData->isEnabled());
    }
}
