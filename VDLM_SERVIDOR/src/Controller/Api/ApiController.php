<?php

namespace App\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api', name: 'api')]
class ApiController extends AbstractController
{
    #[Route('/listProfile', name: 'api_listProfile', methods: ['GET'])]
    public function apiListProfile(EntityManagerInterface $entityManager): JsonResponse 
    {
        $user = $this->getUser();
        $data = [
                'ID' => $user->getId(),
                'NOMBRE' => $user->getNombre(),
                'APELLIDOS' => $user->getApellidos(),
                'EMAIL' => $user->getEmail(),
                'DNI' => $user->getDni(),
                'FECHA_NACIMIENTO' => $user->getFechaNacimiento(),
                'DIRECCION' => $user->getDireccion(),
                'POBLACION' => $user->getPoblacion(),
                'PROVINCIA' => $user->getProvincia(),
                'COD_POSTAL' => $user->getCodPostal(),
                'TITULACIONES' => $user->getTitulaciones(),
                'FECHA_ALTA' => $user->getFechaAlta(),
            ];
        
        return $this->json($data);
    }

}
