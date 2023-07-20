<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Hôtellerie', null, $manager);
            $this->createCategory('Employé(es) de ménage', $parent, $manager);
            $this->createCategory('Employé(es) polyvalent', $parent, $manager);
            $this->createCategory('Réceptionniste', $parent, $manager);
            $this->createCategory('Technicien de maintenance', $parent, $manager);
            $this->createCategory('Veilleur de nuit', $parent, $manager);
        
        $parent = $this->createCategory('Restauration', null, $manager);
            $this->createCategory('Barman', $parent, $manager);
            $this->createCategory('Chef de rang', $parent, $manager);
            $this->createCategory('Commis de cuisine', $parent, $manager);
            $this->createCategory('Cuisinier', $parent, $manager);
            $this->createCategory('Serveur', $parent, $manager);

        $manager->flush();
    }

    public function createCategory(string $name, Categories $parent =null, ObjectManager $manager) 
    {
        $category = new Categories();
        $category->setName($name);
        $category->setParent($parent);
        $manager->persist($category);

        return $category;
    }
}
