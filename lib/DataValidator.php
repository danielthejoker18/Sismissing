<?php

class DataValidator
{
    static function isEmpty($mx_value)
    {
        if (!(strlen($mx_value) > 0))
            return true;
        return false;
    }

    static function isNumeric($mx_value)
    {
        $mx_value = str_replace(',', '.', $mx_value);
        if (!(is_numeric($mx_value)))
            return false;
        return true;
    }

    static function isInteger($mx_value)
    {
        if (!DataValidator::isNumeric($mx_value))
            return false;

        if (preg_match('/[[:punct:]&^-]/', $mx_value) > 0)
            return false;
        return true;
    }
}
