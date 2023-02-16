<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserManagementController extends AbstractController
{
    #[Route('/altaUsuarios', name: 'app_altaUsuarios')]
    public function altaUsuarios(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $entityManager->getRepository(User::class)->insertVoluntario($data);
            return $this->redirectToRoute('app_listUsuarios');
        } else {
            return $this->render('user_management/index.html.twig', [
                'nombre' => $user,
            ]);
        }
    }

    #[Route('/listUsuarios/{page?}', name: 'app_listUsuarios')]
    public function listarUsuarios(?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $data = $entityManager->getRepository(User::class)->findAll();
        return $this->render('user_management/list.html.twig', [
            'nombre' => $user,
            'data' => $data,
            "page" => $this->getLastPage($session, $page)
        ]);
    }

    private function getLastPage(SessionInterface $session, $page)
    {
      if ($page != null) { 
        $session->set("page",$page);
        return $page;
      } elseif (!$session->has("page") || !is_numeric($session->get("page"))) { 
        $session->set("page",1);
        return 1;
      }
      return $session->get("page");
    }
}
