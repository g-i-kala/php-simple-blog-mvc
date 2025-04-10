<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = 5000)
    {
        $value = strlen(trim($value));

        return $value >= $min && $value <= $max;
    }

    public static function integer($value)
    {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_INT);
    }

    public static function email($value)
    {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function url($value)
    {
        $value = trim($value);

        return filter_var($value, FILTER_VALIDATE_URL);
    }

}
