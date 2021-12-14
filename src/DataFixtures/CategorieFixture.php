<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;

class CategorieFixture extends Fixture
{
    public const COURS_CATEGORIE_REFERENCE = 'cours-categorie';
    public function load(ObjectManager $manager): void
    {
        $categories = [];

        $categorie = new Categorie();
        $categorie->setTitre("Cours de piano")
                  ->setContenu("<p>Pour petits et petits</p>")
                  ->setCreeLe(new \Datetime())
                  ->setImage("https://images.static-thomann.de/pics/bdb/332422/12236247_800.jpg");
        $manager->persist($categorie);
        $manager->flush();
//        $categories[] = $categorie;

        $categorie = new Categorie();
        $categorie->setTitre("Cours de violon")
                  ->setContenu("<p>Pour les pros seulement</p>")
                  ->setCreeLe(new \Datetime())
                  ->setImage("https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Old_violin.jpg/280px-Old_violin.jpg");
        $manager->persist($categorie);
        $manager->flush();
//        $categories[] = $categorie;

        $categorie = new Categorie();
        $categorie->setTitre("Cours de flûte")
                  ->setContenu("<p>Uniquement sur RDV le samedi à 0H04</p>")
                  ->setCreeLe(new \Datetime())
                  ->setImage("https://www.stars-music.fr/medias/yamaha/yrs24b-a-bec-scolaire-creme-hd-57649.jpg");
        $manager->persist($categorie);
        $manager->flush();
//        $categories[] = $categorie;

        $categorie = new Categorie();
        $categorie->setTitre("Cours de Ukulélé")
                  ->setContenu("<p>Pour seulement 999.99€ par semaine</p>")
                  ->setCreeLe(new \Datetime())
                  ->setImage("https://images.oxybul.com/Photo/IMG_FICHE_PRODUIT/Image/500x500/3/329683.jpg");
        $manager->persist($categorie);
        $manager->flush();
//        $categories[] = $categorie;
        
        $categorie = new Categorie();
        $categorie->setTitre("Cours de chant")
                  ->setContenu("<p>Vous êtes la prochaine Diva (non)</p>")
                  ->setCreeLe(new \Datetime())
                  ->setImage("https://www.ludwig-van.com/montreal/wp-content/uploads/sites/3/2018/01/Petit-chanteur-cr-JasonRosewell.jpg");

        // $product = new Product();
        $manager->persist($categorie);
        $manager->flush();
//        $categories[] = $categorie;
//        $this->addReference(self::COURS_CATEGORIE_REFERENCE, $categories);
    }
}
