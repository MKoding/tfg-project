<?php

namespace Src\Public\Front\src\Controllers\GetHome;

use Illuminate\View\View;
use Src\Shared\Utils\Core\Application\Providers\FeatureFlagProvider;
use Src\Shared\Utils\Front\Http\Controller;

class GetHomeController extends Controller
{
    private FeatureFlagProvider $featureFlagProvider;

    public function __construct(
        FeatureFlagProvider $featureFlagProvider
    ) {
        $this->featureFlagProvider = $featureFlagProvider;
    }

    public function __invoke(): View
    {
        $getHomeView = new GetHomeView($this->featureFlagProvider);

        return view('Public::GetHome.home', [
            'getHomeView' => $getHomeView
        ]);
    }
}
