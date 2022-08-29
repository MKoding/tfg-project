<?php

namespace Src\Shared\Utils\Core\Application\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function render()
    {
        abort($this->getCode(), $this->getMessage());
    }
}
