<?php

namespace App\Service;

/*
 * this service returns date/ time values
 */

class DateTimeService
{

    public function getCurrentDateAsString(): string
    {
        return date('Y-m-d H:i:s', time());
    }
}

