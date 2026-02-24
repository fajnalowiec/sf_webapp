<?php

namespace App\Service;

/* 
 * this service is gonna send emails to admins when error occures
 */

class ErrorEmailHandler
{
    private array $admins;

    public function __construct(array $admins) {
        $this->admins = $admins;
    }

    public function send(): string
    {
        return 'Email has been sent to: ' . implode(', ', $this->admins);
    }
}

