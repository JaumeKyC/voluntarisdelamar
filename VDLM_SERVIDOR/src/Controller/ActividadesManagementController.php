<?php

namespace App\Controller;

use App\Entity\Actividades;
use App\Entity\User;
use App\Entity\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ActividadesManagementController extends AbstractController
{
    #[Route('/newActividad/{type}', name: 'app_newActividad')]
    public function newActividad(string $type, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($type === "evento") {
            $tipo = false;
            $nombreTipo = 'EVENTO';
        } else {
            $tipo = true;
            $nombreTipo = 'FORMACIÓN';
        }
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $entityManager->getRepository(Actividades::class)->insertActividad($data, $tipo);
            return $this->redirectToRoute('app_menu');
        } else {
            return $this->render('actividades_management/new.html.twig', [
                'nombre' => $user,
                'tipo' => $tipo,
                'nombreTipo' => $nombreTipo,
            ]);
        }
    }

    #[Route('/listActividad/{type}/{page?}', name: 'app_listActividad')]
    public function listActividad(string $type, ?int $page, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $this->getUser();
        if ($type === "evento") {
            $nombreTipo = 'EVENTOS';
            $data = $entityManager->getRepository(Actividades::class)->findBy(['esFormacion' => false]);
            $disabled = [];
            $participa = [];
            foreach ($data as $key) {
                ($key->getVoluntarios() === $key->getMaxVoluntarios()) ? $disabled[] = true : $disabled[] = false;
                $participa[] = $key->getUserId()->contains($user);
            }
        } else {
            $nombreTipo = 'FORMACIONES';
            $data = $entityManager->getRepository(Actividades::class)->findBy(['esFormacion' => true]);
            $disabled = [];
            $participa = [];
            foreach ($data as $key) {
                ($key->getVoluntarios() === $key->getMaxVoluntarios()) ? $disabled[] = true : $disabled[] = false;
                $participa[] = $key->getUserId()->contains($user);
            }
        }

        return $this->render('actividades_management/list.html.twig', [
            'nombre' => $user,
            'nombreTipo' => $nombreTipo,
            'data' => $data,
            'disabled' => $disabled,
            'participa' => $participa,
            "page" => $this->getLastPage($session, $page)
        ]);
    }

    #[Route('/abandonarActividad/{type}/{id}', name: 'app_abandonarActividad')]
    public function abandonarActividad(?int $id, string $type, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($type === "EVENTOS") {
            $nombreTipo = 'evento';
        } else {
            $nombreTipo = 'formacion';
        }
        $user = $this->getUser();
        $actividad = $entityManager->getRepository(Actividades::class)->find($id);
        $actividad->removeUserId($user);
        $entityManager->getRepository(Actividades::class)->eliminarUser($id);
        return $this->redirectToRoute('app_listActividad', ['type' => $nombreTipo]);
    }

    #[Route('/unirseActividad/{type}/{id}', name: 'app_unirseActividad')]
    public function unirseActividad(?int $id, string $type, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($type === "EVENTOS") {
            $nombreTipo = 'evento';
        } else {
            $nombreTipo = 'formacion';
        }
        $user = $this->getUser();
        $actividad = $entityManager->getRepository(Actividades::class)->find($id);
        $actividad->addUserId($user);
        $entityManager->getRepository(Actividades::class)->addUser($id);
        return $this->redirectToRoute('app_listActividad', ['type' => $nombreTipo]);
    }

    #[Route('/updateActividad/{id}', name: 'app_updateActividad')]
    public function updateActividad(?int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $actividad = $entityManager->getRepository(Actividades::class)->find($id);
        $date = $actividad->getFechaInicio();
        $stringDate = $date->format('Y-m-d');
        $horaInicio = $actividad->getHoraInicio();
        $stringHoraInicio = $horaInicio->format('H:i');
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $entityManager->getRepository(Actividades::class)->updateActividad($data, $id);
            return $this->redirectToRoute('app_updateActividad', ['id' => $id]);
        } else {
            return $this->render('actividades_management/update.html.twig', [
                'nombre' => $user,
                'data' => $actividad,
                'date' => $stringDate,
                'hora' => $stringHoraInicio
            ]);
        }
    }

    #[Route('/deleteActividad/{type}/{id}', name: 'app_deleteActividad')]
    public function deleteActividad(?int $id, string $type, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($type === "EVENTOS") {
            $nombreTipo = 'evento';
        } else {
            $nombreTipo = 'formacion';
        }
        $entityManager->getRepository(Actividades::class)->delete($id);
        return $this->redirectToRoute('app_listActividad', ['type' => $nombreTipo]);
    }

    #[Route('/detailActividad/{type}/{id}', name: 'app_detailActividad')]
    public function detailActividad(?int $id, string $type, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $actividad = $entityManager->getRepository(Actividades::class)->find($id);
        ($actividad->getUserId()->contains($user)) ? $participa = true : $participa = false;
        ($actividad->getVoluntarios() === $actividad->getMaxVoluntarios()) ? $disabled = true : $disabled = false;
        $participantes = $actividad->getUserId();
        $date = $actividad->getFechaInicio();
        $stringDate = $date->format('Y-m-d');
        $horaInicio = $actividad->getHoraInicio();
        $stringHoraInicio = $horaInicio->format('H:i');

        return $this->render('actividades_management/detail.html.twig', [
            'nombre' => $user,
            'nombreTipo' => $type,
            'actividad' => $actividad,
            'participa' => $participa,
            'disabled' => $disabled,
            'date' => $stringDate,
            'hora' => $stringHoraInicio,
            'participantes' => $participantes,

        ]);
    }


    private function getLastPage(SessionInterface $session, $page)
    {
        if ($page != null) {
            $session->set("page", $page);
            return $page;
        } elseif (!$session->has("page") || !is_numeric($session->get("page"))) {
            $session->set("page", 1);
            return 1;
        }
        return $session->get("page");
    }
}
