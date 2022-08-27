<?php

namespace Src\Shared\Features\Front\src\Controllers\DeleteFeatureFlag;

use Illuminate\Http\RedirectResponse;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Application\Services\DeleteFeatureFlag\DeleteFeatureFlagService;
use Src\Shared\Utils\Front\Http\Controller;

class DeleteFeatureFlagController extends Controller
{
    private DeleteFeatureFlagService $deleteFeatureFlagService;

    public function __construct(
        DeleteFeatureFlagService $deleteFeatureFlagService
    ) {
        $this->deleteFeatureFlagService = $deleteFeatureFlagService;
    }

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function __invoke(DeleteFeatureFlagRequest $deleteFeatureFlagRequest): RedirectResponse
    {
        $this->deleteFeatureFlagService->execute($deleteFeatureFlagRequest->toDataObject());

        return redirect()->back();
    }
}
