<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createContract('CDI', $manager);
        $this->createContract('CDD', $manager);
        $this->createContract('Mission intérimaire', $manager);
        $this->createContract('CDI intérimaire', $manager);
        $this->createContract('Saisonnier', $manager);
        $this->createContract('Contrat d\'apprentissage', $manager);
        $this->createContract('Contrat de professionnalisation', $manager);
        $this->createContract('Contrat unique d\'insertion', $manager);
        $this->createContract('Contrat d\'insertion par l\'activité', $manager);
        $this->createContract('Contrat d\'accompagnement dans l\'emploi', $manager);
        $this->createContract('Contrat initiative emploi', $manager);
        $this->createContract('Contrat d\'avenir', $manager);


        $manager->flush();
    }

    public function createContract(string $name, ObjectManager $manager) 
    {
        $contract = new Contract();
        $contract->setName($name);
        $manager->persist($contract);

        return $contract;
    }
}
