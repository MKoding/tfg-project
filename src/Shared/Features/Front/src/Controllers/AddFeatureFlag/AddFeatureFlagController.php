<?php

namespace Src\Shared\Features\Front\src\Controllers\AddFeatureFlag;

use Illuminate\Http\RedirectResponse;
use Src\Shared\Features\Core\Application\Services\AddFeatureFlag\AddFeatureFlagService;
use Src\Shared\Utils\Front\Http\Controller;

class AddFeatureFlagController extends Controller
{
    private AddFeatureFlagService $addFeatureFlagService;

    public function __construct(
        AddFeatureFlagService $addFeatureFlagService
    ) {
        $this->addFeatureFlagService = $addFeatureFlagService;
    }

    public function __invoke(AddFeatureFlagRequest $addFeatureFlagRequest): RedirectResponse
    {
        $this->addFeatureFlagService->execute($addFeatureFlagRequest->toDataObject());

        return redirect()->back();
    }
}
