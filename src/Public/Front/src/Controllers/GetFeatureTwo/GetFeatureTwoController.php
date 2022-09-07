<?php

namespace Src\Public\Front\src\Controllers\GetFeatureTwo;

use Illuminate\View\View;
use Src\Shared\Utils\Core\Application\Providers\FeatureFlagProvider;
use Src\Shared\Utils\Front\Http\Controller;

class GetFeatureTwoController extends Controller
{
    public function __invoke(FeatureFlagProvider $featureFlagProvider): View
    {
        if (!$featureFlagProvider->useFeature('feature_2')) {
            abort(404);
        }

        return view('Public::GetFeatureTwo.feature-two');
    }
}
