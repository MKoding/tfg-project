<?php

namespace Src\Shared\Utils\Front\Http;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DateTime;

class BaseRequestData
{
    public static function obtainValueFromRequestStatic($request, string $key): string
    {
        if (empty($request->input($key))) {
            return "";
        }

        return $request->input($key);
    }

    public static function obtainDecodedValueFromRequestStatic($request, string $key): string
    {
        if (empty($request->input($key))) {
            return "";
        }

        return base64_decode($request->input($key));
    }

    public static function obtainRouteParameter($request, string $key): string
    {
        return empty($request->route($key)) ? "" : $request->route($key);
    }

    protected function obtainValueFromRequest($request, string $key): string
    {
        return self::obtainValueFromRequestStatic($request, $key);
    }

    public static function obtainBooleanFromRequestStatic($request, string $key): bool
    {
        if (empty($request->input($key))) {
            return false;
        }

        return filter_var($request->input($key), FILTER_VALIDATE_BOOLEAN);
    }

    public static function obtainArrayFromRequestStatic(Request $request, string $key): array
    {
        if (empty($request->input($key))) {
            return [];
        }
        if (!is_array($request->input($key))) {
            return [$request->input($key)];
        }

        return $request->input($key);
    }

    public static function obtainArrayWithoutEmptyValuesFromRequestStatic(Request $request, string $key): array
    {
        $values =  self::obtainArrayFromRequestStatic($request, $key);
        foreach ($values as $key => $value) {
            if (empty($value)) {
                unset($values[$key]);
            }
        }

        return $values;
    }

    protected function obtainArrayFromRequest($request, string $key): array
    {
        return self::obtainArrayFromRequestStatic($request, $key);
    }

    protected function obtainDatetimeFromRequest($request, string $key): ?DateTime
    {
        if (!empty($request->input($key))) {
            return DateTime::createFromFormat('d-m-Y', $request->input($key));
        }

        return null;
    }

    protected static function obtainFileFromRequestStatic($request, string $key): ?UploadedFile
    {
        if (!empty($request->file($key))) {
            return $request->file($key);
        }

        return null;
    }

    protected static function obtainAllValues($request)
    {
        return $request->all();
    }
}
