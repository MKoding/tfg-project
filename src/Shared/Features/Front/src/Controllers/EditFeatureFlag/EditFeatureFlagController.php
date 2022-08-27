<?php

namespace Src\Shared\Features\Front\src\Controllers\EditFeatureFlag;

use Illuminate\Http\RedirectResponse;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Application\Services\EditFeatureFlag\EditFeatureFlagService;
use Src\Shared\Utils\Front\Http\Controller;

class EditFeatureFlagController extends Controller
{
    private EditFeatureFlagService $editFeatureFlagService;

    public function __construct(
        EditFeatureFlagService $editFeatureFlagService
    ) {
        $this->editFeatureFlagService = $editFeatureFlagService;
    }

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function __invoke(EditFeatureFlagRequest $editFeatureFlagRequest): RedirectResponse
    {
        $this->editFeatureFlagService->execute($editFeatureFlagRequest->toDataObject());

        return redirect()->back();
    }
}
