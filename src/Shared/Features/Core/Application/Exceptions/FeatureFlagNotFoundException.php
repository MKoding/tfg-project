<?php

namespace Src\Shared\Features\Core\Application\Exceptions;

use Src\Shared\Utils\Core\Application\Exceptions\CustomException;
use Symfony\Component\HttpFoundation\Response;

class FeatureFlagNotFoundException extends CustomException
{
    public function __construct()
    {
        parent::__construct(
            __('Feature flag not found'),
            Response::HTTP_NOT_FOUND
        );
    }
}
