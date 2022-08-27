<?php

namespace Src\Admin\Front\src\Controllers\GetFeatureFlags;

use Illuminate\View\View;
use Src\Shared\Utils\Core\Application\Providers\FeatureFlagProvider;
use Src\Shared\Utils\Front\Http\Controller;

class GetFeatureFlagsController extends Controller
{
    private FeatureFlagProvider $featureFlagProvider;

    public function __construct(
        FeatureFlagProvider $featureFlagProvider
    ) {
        $this->featureFlagProvider = $featureFlagProvider;
    }

    public function __invoke(): View
    {
        $getFeatureFlagsView = new GetFeatureFlagsView($this->featureFlagProvider);

        return view('Admin::GetFeatureFlags.table', [
            'getFeatureFlagsView' => $getFeatureFlagsView
        ]);
    }
}
