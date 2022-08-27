<?php

namespace Src\Shared\Features\Front\src\Controllers\EditFeatureFlag;

use Src\Shared\Features\Core\Application\Services\EditFeatureFlag\EditFeatureFlagData;
use Src\Shared\Utils\Front\Http\FormRequest;

class EditFeatureFlagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required | string',
            'enabled' => 'required | boolean'
        ];
    }

    public function toDataObject(): EditFeatureFlagData
    {
        return EditFeatureFlagData::buildFromRequest($this);
    }
}
