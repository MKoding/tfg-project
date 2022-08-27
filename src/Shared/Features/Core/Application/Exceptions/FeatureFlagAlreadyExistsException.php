<?php

namespace Src\Shared\Features\Core\Application\Exceptions;

use Src\Shared\Utils\Core\Application\Exceptions\CustomException;
use Symfony\Component\HttpFoundation\Response;

class FeatureFlagAlreadyExistsException extends CustomException
{
    public function __construct()
    {
        parent::__construct(
            __('Feature flag already exists'),
            Response::HTTP_CONFLICT
        );
    }
}
