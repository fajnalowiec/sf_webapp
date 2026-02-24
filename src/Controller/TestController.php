<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    public function welcome(): Response
    {
        return $this->render('Test/welcome.html.twig', [
            'welcome_message' => 'Hello World',
        ]);
    }
}
