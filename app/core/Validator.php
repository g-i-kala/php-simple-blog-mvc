<?php 

class Validator 
{
    public static function string($value, $min = 1, $max = 1000) 
    {
        $value = strlen(trim($value));
        
        return $value >= $min && $value <= $max;
    }

    public static function email($value)
    {
        $value = trim($value);
        
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

}


