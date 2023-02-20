<?php

namespace App\Controller;

use App\Entity\User;
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
            $entityManager->getRepository(User::class)->insertVoluntario($request, $data);
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

    #[Route('/detailUsuarios/{id}', name: 'app_detailUsuarios')]
    public function detailUsuarios(?int $id, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $voluntario = $entityManager->getRepository(User::class)->find($id);
        if ($voluntario->getRoles()[0] === "ROLE_USER") {
            $role = 'VOLUNTARIO';
        } else {
            $role = 'ADMINISTRADOR';
        }
        if (is_null($voluntario->getTitulaciones())) {
            $arrayTitulaciones =  ['-'];
        } else {
            $titulaciones = $voluntario->getTitulaciones();
            $arrayTitulaciones =  explode(",", $titulaciones);
        }
        $date = $voluntario->getFechaNacimiento();
        $stringDate = $date->format('Y-m-d');
        $dateAlta = $voluntario->getFechaAlta();
        $stringDateAlta = $dateAlta->format('Y-m-d');

        $telf = $voluntario->getTelefono();
        $chars = str_split($telf);
        for ($i = 2; $i < count($chars); $i += 3) {
            $chars[$i] .= " ";
        }
        $telefono = implode($chars);
        return $this->render('user_management/detail.html.twig', [
            'nombre' => $user,
            'voluntario' => $voluntario,
            'fechaAlta' => $stringDateAlta,
            'fechaNacimiento' => $stringDate,
            'role' => $role,
            'telefono' => $telefono,
            'titulaciones' => $arrayTitulaciones
        ]);
    }

    #[Route('/updateUsuarios/{id}', name: 'app_updateUsuarios')]
    public function updateUsuarios(?int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $voluntario = $data = $entityManager->getRepository(User::class)->find($id);
        if (is_null($voluntario->getDireccion())) {
            $direc = '';
        } else {
            $direc = $voluntario->getDireccion();
        }
        if (is_null($voluntario->getPoblacion())) {
            $poblacion = '';
        } else {
            $poblacion = $voluntario->getPoblacion();
        }
        if (is_null($voluntario->getProvincia())) {
            $provincia = '';
        } else {
            $provincia = $voluntario->getProvincia();
        }
        if (is_null($voluntario->getCodPostal())) {
            $codPostal = '';
        } else {
            $codPostal = $voluntario->getCodPostal();
        }
        if (is_null($voluntario->getCamiseta())) {
            $camiseta = '';
        } else {
            $camiseta = $voluntario->getCamiseta();
        }
        if (is_null($voluntario->getVolunLaCaixa())) {
            $volunCaixa = '';
        } else {
            $volunCaixa = $voluntario->getVolunLaCaixa();
        }
        if (is_null($voluntario->getIban())) {
            $iban = '';
        } else {
            $iban = $voluntario->getIban();
        }
        if ($voluntario->getRoles()[0] === "ROLE_USER") {
            $switch = '';
        } else {
            $switch = 'checked';
        }
        if (is_null($voluntario->getTitulaciones())) {
            $titulaciones = '';
        } else {
            $titulaciones = $voluntario->getTitulaciones();
        }
        $date = $voluntario->getFechaNacimiento();
        $stringDate = $date->format('Y-m-d');
        $dateAlta = $voluntario->getFechaAlta();
        $stringDateAlta = $dateAlta->format('Y-m-d');
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $entityManager->getRepository(User::class)->updateVoluntario($request, $data, $id);
            return $this->redirectToRoute('app_updateUsuarios', ['id' => $id]);
        } else {
            return $this->render('user_management/update.html.twig', [
                'nombre' => $user,
                'voluntario' => $voluntario,
                'direccion' => $direc,
                'poblacion' => $poblacion,
                'provincia' => $provincia,
                'codPostal' => $codPostal,
                'fechaAlta' => $stringDateAlta,
                'fechaNacimiento' => $stringDate,
                'camiseta' => $camiseta,
                'volunCaixa' => $volunCaixa,
                'iban' => $iban,
                'switch' => $switch,
                'titulaciones' => $titulaciones,
            ]);
        }
    }

    #[Route('/deleteUsuario/{id}', name: 'app_deleteUsuario')]
    public function deleteUsuario(EntityManagerInterface $entityManager, $id): Response
    {
        $data = $entityManager->getRepository(User::class)->find($id);
        $entityManager->getRepository(User::class)->delete($data->getId());
        return $this->redirectToRoute('app_listUsuarios');
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
