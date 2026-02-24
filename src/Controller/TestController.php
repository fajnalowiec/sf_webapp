<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ErrorEmailHandler;

class TestController extends AbstractController
{
    public function welcome(): Response
    {        
        return $this->render('Test/welcome.html.twig', [
            'welcome_message' => 'Hello World',
        ]);
    }

/*
 * because of autowiring in services.yml I can inject monolog logger here
 * I know that LoggerInterface should be used by using:
 * ./bin/console debug:autowiring | grep log
 * or
 * ./bin/console debug:container | grep log
 * Autowiring automatically creates services when needed. I do not need to manually
 * add and config them in services.yml
 */

    public function logIt(LoggerInterface $logger): Response
    {
        $logger->info('test::welcome invoked');
        $this->addFlash('success', 'log added');
        return $this->render('Test/log_it.html.twig', []);
    }

    public function errorOccured(ErrorEmailHandler $errorEmailHandler): Response
    {
        try {
            $x = 0;
            $y = 23 / $x;
        } catch (\Throwable $e) {
            $msg = $errorEmailHandler->send();
            return new Response($msg);
        }
    }
}
