<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/adminMenu', name: 'app_menu')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('menu/index.html.twig', [
            'nombre' => $user,
        ]);
    }
}
