<?php

namespace App\Controller\Api;

use App\Entity\Actividades;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/api', name: 'api')]
class ApiController extends AbstractController
{
    #[Route('/listProfile/{id}', name: 'api_listProfile', methods: ['GET'])]
    public function apiListProfile(?int $id, EntityManagerInterface $entityManager): JsonResponse
    {
        //$user = $this->getUser();
        $user = $entityManager->getRepository(User::class)->find($id);
        $data = [
            'ID' => $user->getId(),
            'NOMBRE' => $user->getNombre(),
            'APELLIDOS' => $user->getApellidos(),
            'EMAIL' => $user->getEmail(),
            'DNI' => $user->getDni(),
            'TELEFONO' => $user->getTelefono(),
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

    #[Route('/updateProfile/{id}', name: 'api_updateProfile', methods: ['POST'])]
    public function updateProfile(?int $id, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $entityManager->getRepository(User::class)->find($id);
        $idUser = $user->getId();
        $entityManager->getRepository(User::class)->updateUserOwnProfile($data, $idUser);
        return $this->json(['message' => "User actualizado correctamente"]);
    }


    #[Route('/listActividades/{id}', name: 'api_listActividades', methods: ['GET'])]
    public function listActividades(?int $id, EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializer): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($id);
        $listEventosUser = $user->getActividades();
        $listEventosTotal = $entityManager->getRepository(Actividades::class)->findAll();
        $data = [];

        $eventosUserIds = array_map(function ($evento) {
            return $evento->getId();
        }, $listEventosUser->toArray());

        foreach ($listEventosTotal as $actividad) {
            $userJoined = $listEventosUser->contains($actividad);

            $data[] = [
                'ID' => $actividad->getId(),
                'ES_FORMACION' => $actividad->getEsFormacion(),
                'NOMBRE' => $actividad->getNombre(),
                'FECHA_INICIO' => $actividad->getFechaInicio(),
                'HORA_INICIO' => $actividad->getHoraInicio(),
                'UBICACION' => $actividad->getUbicacion(),
                'ENTIDAD_ORGANIZADORA' => $actividad->getEntidadOrganizadora(),
                'NUM_EMBARCACIONES' => $actividad->getNumEmbarcaciones(),
                'NUM_MOTOS' => $actividad->getNumMotos(),
                'NUM_PATRONES' => $actividad->getNumPatrones(),
                'NUM_TRIPULANTES' => $actividad->getNumTripulantes(),
                'NUM_SOCORRISTAS' => $actividad->getNumSocorristas(),
                'OBSERVACIONES' => $actividad->getObservaciones(),
                'VOLUNTARIOS' => $actividad->getVoluntarios(),
                'MAX_VOLUNTARIOS' => $actividad->getMaxVoluntarios(),
                'USER_JOINED' => $userJoined,
            ];
        }
        $serializedData = $serializer->serialize($data, 'json');

        return new JsonResponse($serializedData, 200, [], true);
    }

    #[Route('/showActividad/{id}/{userId}', name: 'api_showActividad', methods: ['GET'])]
    public function apiShowActividad(?int $id, ?int $userId,EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $entityManager->getRepository(User::class)->find($userId);
        $actividad = $entityManager->getRepository(Actividades::class)->find($id);
        $userJoined = $actividad->getUserId()->contains($user);
        $data = [
            'ID' => $actividad->getId(),
            'ES_FORMACION' => $actividad->getEsFormacion(),
            'NOMBRE' => $actividad->getNombre(),
            'FECHA_INICIO' => $actividad->getFechaInicio(),
            'HORA_INICIO' => $actividad->getHoraInicio(),
            'UBICACION' => $actividad->getUbicacion(),
            'ENTIDAD_ORGANIZADORA' => $actividad->getEntidadOrganizadora(),
            'NUM_EMBARCACIONES' => $actividad->getNumEmbarcaciones(),
            'NUM_MOTOS' => $actividad->getNumMotos(),
            'NUM_PATRONES' => $actividad->getNumPatrones(),
            'NUM_TRIPULANTES' => $actividad->getNumTripulantes(),
            'NUM_SOCORRISTAS' => $actividad->getNumSocorristas(),
            'OBSERVACIONES' => $actividad->getObservaciones(),
            'VOLUNTARIOS' => $actividad->getVoluntarios(),
            'MAX_VOLUNTARIOS' => $actividad->getMaxVoluntarios(),
            'USER_JOINED' => $userJoined,
        ];

        return $this->json($data);
    }

    #[Route('/updateActividades/{id}', name: 'api_updateActividades', methods: ['POST'])]
    public function updateActividades(?int $id, EntityManagerInterface $entityManager, Request $request,  SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $user = $entityManager->getRepository(User::class)->find($id);
        $idUser = $user->getId();
        $event = $entityManager->getRepository(Actividades::class)->find($data["id"]);
        if ($data["user_joined"] === true) {
            if($event->getVoluntarios() === $event->getMaxVoluntarios()){
                return $this->json(['message' => "Error! Máximo de voluntarios participantes"]);
            }else{
                $entityManager->getRepository(Actividades::class)->updateActividadApi($data, $idUser);
                $event = $entityManager->getRepository(Actividades::class)->find($data["id"]);
                $eventUpdate = [
                    'ID' => $event->getId(),
                    'ES_FORMACION' => $event->getEsFormacion(),
                    'NOMBRE' => $event->getNombre(),
                    'FECHA_INICIO' => $event->getFechaInicio(),
                    'HORA_INICIO' => $event->getHoraInicio(),
                    'UBICACION' => $event->getUbicacion(),
                    'ENTIDAD_ORGANIZADORA' => $event->getEntidadOrganizadora(),
                    'NUM_EMBARCACIONES' => $event->getNumEmbarcaciones(),
                    'NUM_MOTOS' => $event->getNumMotos(),
                    'NUM_PATRONES' => $event->getNumPatrones(),
                    'NUM_TRIPULANTES' => $event->getNumTripulantes(),
                    'NUM_SOCORRISTAS' => $event->getNumSocorristas(),
                    'OBSERVACIONES' => $event->getObservaciones(),
                    'VOLUNTARIOS' => $event->getVoluntarios(),
                    'MAX_VOLUNTARIOS' => $event->getMaxVoluntarios(),
                    'USER_JOINED' => true,
                ];
                $serializedData = $serializer->serialize($eventUpdate, 'json');
                return new JsonResponse($serializedData, 200, [], true);
            }
        } else {
            if($event->getVoluntarios() === 0){
                return $this->json(['message' => "Error! No hay voluntarios participantes"]);
            }else{
                $entityManager->getRepository(Actividades::class)->updateActividadApi($data, $idUser);
                $event = $entityManager->getRepository(Actividades::class)->find($data["id"]);
                $eventUpdate = [
                    'ID' => $event->getId(),
                    'ES_FORMACION' => $event->getEsFormacion(),
                    'NOMBRE' => $event->getNombre(),
                    'FECHA_INICIO' => $event->getFechaInicio(),
                    'HORA_INICIO' => $event->getHoraInicio(),
                    'UBICACION' => $event->getUbicacion(),
                    'ENTIDAD_ORGANIZADORA' => $event->getEntidadOrganizadora(),
                    'NUM_EMBARCACIONES' => $event->getNumEmbarcaciones(),
                    'NUM_MOTOS' => $event->getNumMotos(),
                    'NUM_PATRONES' => $event->getNumPatrones(),
                    'NUM_TRIPULANTES' => $event->getNumTripulantes(),
                    'NUM_SOCORRISTAS' => $event->getNumSocorristas(),
                    'OBSERVACIONES' => $event->getObservaciones(),
                    'VOLUNTARIOS' => $event->getVoluntarios(),
                    'MAX_VOLUNTARIOS' => $event->getMaxVoluntarios(),
                    'USER_JOINED' => false,
                ];
                $serializedData = $serializer->serialize($eventUpdate, 'json');
                return new JsonResponse($serializedData, 200, [], true);
            }
        }
    }
}
