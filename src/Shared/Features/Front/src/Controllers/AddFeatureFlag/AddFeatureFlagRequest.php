<?php

namespace Src\Shared\Features\Front\src\Controllers\AddFeatureFlag;

use Src\Shared\Features\Core\Application\Services\AddFeatureFlag\AddFeatureFlagData;
use Src\Shared\Utils\Front\Http\FormRequest;

class AddFeatureFlagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required | string',
            'enabled' => 'required | boolean'
        ];
    }

    public function toDataObject(): AddFeatureFlagData
    {
        return AddFeatureFlagData::buildFromRequest($this);
    }
}
