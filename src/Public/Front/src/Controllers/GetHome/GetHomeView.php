<?php

namespace Src\Public\Front\src\Controllers\GetHome;

use Src\Shared\Utils\Core\Application\Providers\FeatureFlagProvider;

class GetHomeView
{
    private FeatureFlagProvider $featureFlagProvider;

    public function __construct(FeatureFlagProvider $featureFlagProvider)
    {
        $this->featureFlagProvider = $featureFlagProvider;
    }

    public function useFeature(string $name): bool
    {
        return $this->featureFlagProvider->useFeature($name);
    }
}
