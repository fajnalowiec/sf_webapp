<?php

namespace App\Service;

use App\Service\DateTimeService;

/* 
 * this service is gonna send emails to admins when error occures
 */

class ErrorEmailHandler
{
    private array $admins;
    private DateTimeService $dateTimeService;

    public function __construct(array $admins, DateTimeService $dateTimeService) {
        $this->admins = $admins;
        $this->dateTimeService = $dateTimeService;
    }

    public function send(): string
    {
        $date = $this->dateTimeService->getCurrentDateAsString();
        return $date . ' - Email has been sent to: ' . implode(', ', $this->admins);
    }
}

