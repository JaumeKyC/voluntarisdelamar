<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry, private UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct($registry, User::class);
    }

    public function insertVoluntario($request, array $data,): void
    {
        $user = new User;
        $hashedPass = $this->userPasswordHasher->hashPassword($user, $data["PASSWORD"]);
        $user->setPassword($hashedPass);
        if (isset($_POST['ADMIN']) && $_POST['ADMIN'] === 'on') {
            $esAdmin = ['ROLE_ADMIN'];
        } else {
            $esAdmin = ['ROLE_USER'];
        }
        $fechaNacimiento = new DateTime($data['FECHA_NACIMIENTO']);
        $fechaNacimiento->format("d/m/Y");
        $fechaAlta = new DateTime($data['FECHA_ALTA']);
        $fechaAlta->format("d/m/Y");

        $file = $request->files->get('FICHA_SEPA');
        if (!is_null($file)) {
            $file->move('assets/pdf/tmp/', $file . '.pdf');
            $user->setFichaSepa($file . '.pdf');
        }

        $user
            ->setNombre($data["NOMBRE"])
            ->setApellidos($data["APELLIDOS"])
            ->setEmail($data["EMAIL"])
            ->setPassword($hashedPass)
            ->setRoles($esAdmin)
            ->setDni($data["DNI"])
            ->setFechaNacimiento($fechaNacimiento)
            ->setDireccion($data["DIRECCION"])
            ->setPoblacion($data["POBLACION"])
            ->setProvincia($data["PROVINCIA"])
            ->setCodPostal($data["COD_POSTAL"])
            ->setCamiseta($data["CAMISETA"])
            ->setTelefono($data["TELEFONO"])
            ->setVolunLaCaixa($data["VOLUN_LA_CAIXA"])
            ->setIban($data["IBAN"])
            ->setTitulaciones($data["TITULACIONES"])
            ->setFechaAlta($fechaAlta);
        $this->save($user, true);
    }

    public function updateVoluntario($request, array $data, ?int $id): void
    {
        $user = $this->find($id);
        if (!is_null($data["PASSWORD"])) {
            $hashedPass = $this->userPasswordHasher->hashPassword($user, $data["PASSWORD"]);
            $user->setPassword($hashedPass);
            $fechaNacimiento = new DateTime($data['FECHA_NACIMIENTO']);
            $fechaNacimiento->format("d/m/Y");
            $fechaAlta = new DateTime($data['FECHA_ALTA']);
            $fechaAlta->format("d/m/Y");
            if (isset($_POST['ADMIN']) && $_POST['ADMIN'] === 'on') {
                $esAdmin = ['ROLE_ADMIN'];
            } else {
                $esAdmin = ['ROLE_USER'];
            }

            $file = $request->files->get('FICHA_SEPA');
            if (!is_null($file)) {
                $file->move('assets/pdf/tmp/', $file . '.pdf');
                $user->setFichaSepa($file . '.pdf');
            }

            $user
                ->setNombre($data["NOMBRE"])
                ->setApellidos($data["APELLIDOS"])
                ->setEmail($data["EMAIL"])
                ->setDni($data["DNI"])
                ->setFechaNacimiento($fechaNacimiento)
                ->setDireccion($data["DIRECCION"])
                ->setPoblacion($data["POBLACION"])
                ->setProvincia($data["PROVINCIA"])
                ->setCodPostal($data["COD_POSTAL"])
                ->setCamiseta($data["CAMISETA"])
                ->setTelefono($data["TELEFONO"])
                ->setVolunLaCaixa($data["VOLUN_LA_CAIXA"])
                ->setIban($data["IBAN"])
                ->setTitulaciones($data["TITULACIONES"])
                ->setFechaAlta($fechaAlta)
                ->setRoles($esAdmin);
            $this->save($user, true);
        } else {
            if (isset($_POST['ADMIN']) && $_POST['ADMIN'] === 'on') {
                $esAdmin = ['ROLE_ADMIN'];
            } else {
                $esAdmin = ['ROLE_USER'];
            }
            $fechaNacimiento = new DateTime($data['FECHA_NACIMIENTO']);
            $fechaNacimiento->format("d/m/Y");
            $fechaAlta = new DateTime($data['FECHA_ALTA']);
            $fechaAlta->format("d/m/Y");

            $file = $request->files->get('FICHA_SEPA');
            if (!is_null($file)) {
                $file->move('assets/pdf/tmp/', $file . '.pdf');
                $user->setFichaSepa($file . '.pdf');
            }

            $user
                ->setNombre($data["NOMBRE"])
                ->setApellidos($data["APELLIDOS"])
                ->setEmail($data["EMAIL"])
                ->setRoles($esAdmin)
                ->setDni($data["DNI"])
                ->setFechaNacimiento($fechaNacimiento)
                ->setDireccion($data["DIRECCION"])
                ->setPoblacion($data["POBLACION"])
                ->setProvincia($data["PROVINCIA"])
                ->setCodPostal($data["COD_POSTAL"])
                ->setCamiseta($data["CAMISETA"])
                ->setTelefono($data["TELEFONO"])
                ->setVolunLaCaixa($data["VOLUN_LA_CAIXA"])
                ->setIban($data["IBAN"])
                ->setTitulaciones($data["TITULACIONES"])
                ->setFechaAlta($fechaAlta);
            $this->save($user, true);
        }
    }

    public function delete(int $id): void
    {
        $user = $this->find($id);
        $this->remove($user, true);
    }

    public function updateUserOwnProfile(array $data, ?int $id): void
    {
        $user = $this->find($id);
        $hashedPass = $this->userPasswordHasher->hashPassword($user, $data["password"]);
        $user->setPassword($hashedPass);
        $user
            ->setDireccion($data["direccion"])
            ->setPoblacion($data["poblacion"])
            ->setProvincia($data["provincia"])
            ->setCodPostal($data["codPostal"])
            ->setTelefono($data["telefono"]);
        $this->save($user, true);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
