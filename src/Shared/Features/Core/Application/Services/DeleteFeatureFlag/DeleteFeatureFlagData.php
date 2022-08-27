<?php

namespace Src\Shared\Features\Core\Application\Services\DeleteFeatureFlag;

use Src\Shared\Features\Front\src\Controllers\DeleteFeatureFlag\DeleteFeatureFlagRequest;
use Src\Shared\Utils\Front\Http\BaseRequestData;

class DeleteFeatureFlagData extends BaseRequestData
{
    private string $name;

    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }

    public static function buildFromRequest(DeleteFeatureFlagRequest $deleteFeatureFlagRequest): DeleteFeatureFlagData
    {
        return new self(
            self::obtainValueFromRequestStatic($deleteFeatureFlagRequest, 'name'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }
}
