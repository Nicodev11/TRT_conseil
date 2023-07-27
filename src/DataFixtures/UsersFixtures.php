<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setGenre('Monsieur');
        $admin->setEmail('admin@trg-conseil.fr');
        $admin->setLastname('Andres');
        $admin->setFirstname('Julian');
        $admin->setCity('Paris');
        $admin->setZip('75000');
        $admin->setAdress('1 rue de la paix');
        $admin->setPhone('0612568475');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'Nico5780!')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $consultant = new Users();
        $consultant->setGenre('Monsieur');
        $consultant->setEmail('consultant@trg-conseil.fr');
        $consultant->setLastname('Masselin');
        $consultant->setFirstname('Manuel');
        $consultant->setCity('Gruissan');
        $consultant->setZip('11430');
        $consultant->setAdress('1 rue de la paix');
        $consultant->setPhone('0612568475');
        $consultant->setPassword(
            $this->passwordEncoder->hashPassword($consultant, 'Nico5780!')
        );
        $consultant->setRoles(['ROLE_CONSULTANT']);
        $manager->persist($consultant);

        $recruiter = new Users();
        $recruiter->setGenre('Monsieur');
        $recruiter->setEmail('recruiter@trg-conseil.fr');
        $recruiter->setLastname('Bouvier');
        $recruiter->setFirstname('Nicolas');
        $recruiter->setCity('Paris');
        $recruiter->setZip('75000');
        $recruiter->setAdress('1 rue de la paix');
        $recruiter->setPhone('0612568475');
        $recruiter->setPassword(
            $this->passwordEncoder->hashPassword($recruiter, 'Nico5780!')
        );
        $recruiter->setRoles(['ROLE_RECRUITER']);
        $manager->persist($recruiter);

        $manager->flush();
    }
}