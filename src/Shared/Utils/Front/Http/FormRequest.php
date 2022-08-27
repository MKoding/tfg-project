<?php

namespace Src\Shared\Utils\Front\Http;

use DateTime;
use Illuminate\Foundation\Http\FormRequest as HttpFormRequest;
use Illuminate\Http\UploadedFile;

abstract class FormRequest extends HttpFormRequest
{
    abstract public function toDataObject();

    protected function obtainValueFromRequest(string $key): string
    {
        if (empty($this->input($key))) {
            return "";
        }

        return $this->input($key);
    }

    protected function obtainDecodedValueFromRequest(string $key): string
    {
        if (empty($this->input($key))) {
            return "";
        }

        return base64_decode($this->input($key));
    }

    protected function obtainRouteParameter(string $key): string
    {
        return empty($this->route($key)) ? "" : $this->route($key);
    }

    protected function obtainBooleanFromRequest(string $key): bool
    {
        if (empty($this->input($key))) {
            return false;
        }

        return filter_var($this->input($key), FILTER_VALIDATE_BOOLEAN);
    }

    protected function obtainArrayFromRequest(string $key): array
    {
        if (empty($this->input($key))) {
            return [];
        }
        if (!is_array($this->input($key))) {
            return [$this->input($key)];
        }

        return $this->input($key);
    }

    protected function obtainArrayWithoutEmptyValuesFromRequest(string $key): array
    {
        $values =  $this->obtainArrayFromRequest($key);
        foreach ($values as $key => $value) {
            if (empty($value)) {
                unset($values[$key]);
            }
        }

        return $values;
    }

    protected function obtainDatetimeFromRequest(string $key): ?DateTime
    {
        if (!empty($this->input($key))) {
            return DateTime::createFromFormat('d-m-Y', $this->input($key));
        }

        return null;
    }

    protected function obtainFileFromRequestStatic(string $key): ?UploadedFile
    {
        if (!empty($this->file($key))) {
            return $this->file($key);
        }

        return null;
    }

    protected function obtainAllValues(): array
    {
        return $this->all();
    }
}
