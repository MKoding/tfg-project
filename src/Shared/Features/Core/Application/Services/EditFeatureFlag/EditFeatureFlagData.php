<?php

namespace Src\Shared\Features\Core\Application\Services\EditFeatureFlag;

use Src\Shared\Features\Front\src\Controllers\EditFeatureFlag\EditFeatureFlagRequest;
use Src\Shared\Utils\Front\Http\BaseRequestData;

class EditFeatureFlagData extends BaseRequestData
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

    public static function buildFromRequest(EditFeatureFlagRequest $editFeatureFlagRequest): EditFeatureFlagData
    {
        return new self(
            self::obtainValueFromRequestStatic($editFeatureFlagRequest, 'name'),
            self::obtainBooleanFromRequestStatic($editFeatureFlagRequest, 'enabled'),
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
