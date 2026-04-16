<?php

namespace App\Service;

class MyService implements MyServiceInterface
{

    public function hello(): string
    {
        return 'hello there!';
    }
}

