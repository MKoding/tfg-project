<?php

namespace Src\Shared\Features\Core\Application\Services\AddFeatureFlag;

use Src\Shared\Features\Front\src\Controllers\AddFeatureFlag\AddFeatureFlagRequest;
use Src\Shared\Utils\Front\Http\BaseRequestData;

class AddFeatureFlagData extends BaseRequestData
{
    private string $name;
    private bool $enabled;

    public function __construct(
        string $name,
        bool $enabled
    ) {
        $this->name = $name;
        $this->enabled = $enabled;
    }

    public static function buildFromRequest(AddFeatureFlagRequest $addFeatureFlagRequest): AddFeatureFlagData
    {
        return new self(
            self::obtainValueFromRequestStatic($addFeatureFlagRequest, 'name'),
            self::obtainBooleanFromRequestStatic($addFeatureFlagRequest, 'enabled'),
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
