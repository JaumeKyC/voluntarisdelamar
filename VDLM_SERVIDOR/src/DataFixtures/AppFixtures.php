<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTime;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        /*$user = new User();
        $user->setEmail('user@gmail.com');
        $hashedPass = $this->userPasswordHasher->hashPassword($user, 'user');
        $user->setPassword($hashedPass);
        $user->setFechaNacimiento(DateTime::createFromFormat('d/m/Y', '15/02/1995'));
        $user->setFechaAlta(DateTime::createFromFormat('d/m/Y', '13/02/2023'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);
        $manager->flush();*/

        $admin = new User();
        $admin->setEmail('admin@gmail.com');
        $hashedPass = $this->userPasswordHasher->hashPassword($admin, '1234');
        $admin->setPassword($hashedPass);
        $admin->setNombre('Natalia');
        $admin->setApellidos('Fernández Cañadas');
        $admin->setDni('12345678K');
        $admin->setTelefono('123456789');
        $admin->setFechaNacimiento(DateTime::createFromFormat('d/m/Y', '15/02/1995'));
        $admin->setDireccion('Calle Falsa 123');
        $admin->setPoblacion('Valencia');
        $admin->setCodPostal('46007');
        $admin->setProvincia('Valencia');
        $admin->setFechaAlta(DateTime::createFromFormat('d/m/Y', '13/02/2023'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setTitulaciones('Titulacion1, Titulacion2, Titulacion3');
        $manager->persist($admin);
        $manager->flush();
    }
}
