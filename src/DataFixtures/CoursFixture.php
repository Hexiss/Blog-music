<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cours;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CoursFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 8; $i++) {
            $categorie = new Categorie();
            $categorie->setTitre($faker->sentence())
                ->setContenu($faker->sentence())
                ->setCreeLe($faker->dateTimeBetween('-1 mounths'))
                ->setImage($faker->imageUrl());

            $manager->persist($categorie);

            for ($j = 1; $j <= mt_rand(3, 6); $j++) {
                $cours = new Cours();
                $cours->setTitre("Titre de la catégorie n°$i")
                    ->setdecription($faker->sentence())
                    ->setDate($faker->dateTime())
                    ->setCategories($categorie);
                //              ->setCategories($this->getReference(CategorieFixture::COURS_CATEGORIE_REFERENCE));

                $manager->persist($cours);
            }
        }
        $manager->flush();
    }
}
