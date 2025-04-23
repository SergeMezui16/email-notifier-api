<?php

namespace App\Controller;

use App\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    #[Route('/', name: 'app_home', methods: ['POST'])]
    public function send(#[MapRequestPayload] Event $event, MailerInterface $mailer): JsonResponse
    {
        // Send email
        $email = (new Email())
            ->from('test@sergemezui.dev')
            ->subject($event->description)
            ->to('sergemezui.dev@gmail.com')
            ->html("
                <h1>{$event->description}</h1>
                <p>Identifier: {$event->identifier}</p>
                <p>Longitude: {$event->longitude}</p>
                <p>Latitude: {$event->latitude}</p>
                <p>Date: {$event->date->format('Y-m-d H:i:s')}</p>
        "
        );

        $mailer->send($email);
        return $this->json($event);
    }
}
