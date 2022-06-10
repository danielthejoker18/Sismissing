<?php

class DataFilter
{
    static function alphaNum( $st_data )
    {
        $st_data = preg_replace("([[:punct:]]| )",'',$st_data);
        return $st_data;
    }

    static function numeric( $st_data )
    {
        $st_data = preg_replace("([[:punct:]]|[[:alpha:]]| )",'',$st_data);
        return $st_data;
    }

    static function cleanString( $st_string )
    {
        return addslashes(strip_tags($st_string));
    }

    static function dateFilter ($value)
    {
        $date = new DateTime($value);
        return $date->format('d/m/Y');
    }
}
