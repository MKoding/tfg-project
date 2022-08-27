<?php

namespace Src\Admin\Front\src\Controllers\GetFeatureFlags;

use Src\Shared\Utils\Core\Application\Providers\FeatureFlagProvider;
use Src\Shared\Features\Core\Domain\FeatureFlag;

class GetFeatureFlagsView
{
    private FeatureFlagProvider $featureFlagProvider;

    public function __construct(FeatureFlagProvider $featureFlagProvider)
    {
        $this->featureFlagProvider = $featureFlagProvider;
    }

    /**
     * @return FeatureFlag[]
     */
    public function getFeatureFlags(): array
    {
        return $this->featureFlagProvider->getFeatureFlags();
    }
}
