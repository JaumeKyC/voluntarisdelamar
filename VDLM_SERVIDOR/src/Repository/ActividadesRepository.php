<?php

namespace App\Repository;

use App\Entity\Actividades;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @extends ServiceEntityRepository<Actividades>
 *
 * @method Actividades|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actividades|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actividades[]    findAll()
 * @method Actividades[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActividadesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actividades::class);
    }

    public function insertActividad(array $data, $tipo): void
    {
        $actividad = new Actividades;
        $fechaInicio = new DateTime($data['FECHA_INICIO']);
        $fechaInicio->format("d/m/Y");
        $horaInicio = new DateTime($data['HORA_INICIO']);
        $horaInicio->format("H:i:s");

        $actividad
            ->setNombre($data["NOMBRE"])
            ->setEsFormacion($tipo)
            ->setFechaInicio($fechaInicio)
            ->setHoraInicio($horaInicio)
            ->setUbicacion($data["UBICACION"])
            ->setEntidadOrganizadora($data["ENTIDAD_ORGANIZADORA"])
            ->setNumEmbarcaciones($data["NUM_EMBARCACIONES"])
            ->setNumMotos($data["NUM_MOTOS"])
            ->setNumPatrones($data["NUM_PATRONES"])
            ->setNumTripulantes($data["NUM_TRIPULANTES"])
            ->setNumSocorristas($data["NUM_SOCORRISTAS"])
            ->setObservaciones($data["OBSERVACIONES"])
            ->setVoluntarios(0)
            ->setMaxVoluntarios($data["MAX_VOLUNTARIOS"]);
        $this->save($actividad, true);
    }

    public function updateActividad(array $data, $id): void
    {
        $actividad = $this->find($id);
        $fechaInicio = new DateTime($data['FECHA_INICIO']);
        $fechaInicio->format("d/m/Y");
        $horaInicio = new DateTime($data['HORA_INICIO']);
        $horaInicio->format("H:i:s");

        $actividad
            ->setNombre($data["NOMBRE"])
            ->setFechaInicio($fechaInicio)
            ->setHoraInicio($horaInicio)
            ->setUbicacion($data["UBICACION"])
            ->setEntidadOrganizadora($data["ENTIDAD_ORGANIZADORA"])
            ->setNumEmbarcaciones($data["NUM_EMBARCACIONES"])
            ->setNumMotos($data["NUM_MOTOS"])
            ->setNumPatrones($data["NUM_PATRONES"])
            ->setNumTripulantes($data["NUM_TRIPULANTES"])
            ->setNumSocorristas($data["NUM_SOCORRISTAS"])
            ->setObservaciones($data["OBSERVACIONES"])
            ->setMaxVoluntarios($data["MAX_VOLUNTARIOS"]);
        $this->save($actividad, true);
    }

    public function eliminarUser($id): void
    {
        $actividad = $this->find($id);
        $count = $actividad->getVoluntarios();
        $count--;
        $actividad
            ->setVoluntarios($count);
        $this->save($actividad, true);
    }

    public function addUser($id): void
    {
        $actividad = $this->find($id);
        $count = $actividad->getVoluntarios();
        $count++;
        $actividad
            ->setVoluntarios($count);
        $this->save($actividad, true);
    }

    public function delete(int $id): void
    {
        $actividad = $this->find($id);
        $this->remove($actividad, true);
    }

    public function updateActividadApi(array $data, ?int $userId): void
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($userId);
        $event = $this->find($data["id"]);
        $voluntarios = $event->getUserId();
        $total = count($voluntarios);
        if ($data["user_joined"] === true) {
            $user->addActividades($event);
            $total++;
            $event
                ->addUserId($user)
                ->setVoluntarios($total);
            $this->save($event, true);
        } else {
            $user->removeActividades($event);
            $total--;
            $event
                ->removeUserId($user)
                ->setVoluntarios($total);
            $this->save($event, true);
        }
    }

    public function save(Actividades $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Actividades $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Actividades[] Returns an array of Actividades objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Actividades
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
