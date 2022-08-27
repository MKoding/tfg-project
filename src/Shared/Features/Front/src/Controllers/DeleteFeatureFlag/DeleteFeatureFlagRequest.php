<?php

namespace Src\Shared\Features\Front\src\Controllers\DeleteFeatureFlag;

use Src\Shared\Features\Core\Application\Services\DeleteFeatureFlag\DeleteFeatureFlagData;
use Src\Shared\Utils\Front\Http\FormRequest;

class DeleteFeatureFlagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required | string'
        ];
    }

    public function toDataObject(): DeleteFeatureFlagData
    {
        return DeleteFeatureFlagData::buildFromRequest($this);
    }
}
