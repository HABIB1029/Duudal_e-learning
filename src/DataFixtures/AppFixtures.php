<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cours;
use App\Entity\Video;
use App\Entity\Niveau;
use App\Entity\Comment;
use App\Entity\Chapitre;
use App\Entity\Document;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("fr_FR");

        $slugger= new Slugify();
         for ($i = 0; $i < 4 ; $i++){
 
         $niveau = new Niveau();
         $niveau->setTitle($faker->sentence(3, false));
         $niveau->setCreatedAt($faker->dateTimeBetween('-3 month','now'));
         $manager ->persist($niveau);

         for($j = 0; $j < 2 ; $j++ ){
            $cours = new Cours();
            $cours->setTitle($faker->sentence(3, false))
                    ->setDescription($faker->sentence(3, False))
                    ->setCreatAt($faker->dateTimeBetween('-3 month','now'))
                    ->setIsAvailable(mt_rand(0, 1))
                     ;
    
        $manager ->persist($cours);
         $niveau->addcour($cours);
         //permet à doctrine d'enregistrer dans la BD
         }
         
         for($k = 0; $k < 2 ; $k++ ){
         $chapitre = new Chapitre();
         $chapitre->setTitle($faker->sentence(3, false));
         $chapitre->setDocumentExtension( "http://exo7.emath.fr/ficpdf/fic00020.pdf");
         $chapitre->setDescription($faker->sentence(3, False));
         $chapitre->setIsAvailable(mt_rand(0, 1));
         $chapitre->setCreatedAt($faker->dateTimeBetween('-3 month','now'));
         $chapitre->setVideoExtension("https://www.youtube.com/embed/v64KOxKVLVg");
        $chapitre->setSlug($slugger->slugify($chapitre->getTitle()));
        
        $manager ->persist($chapitre);
        $cours->addchapitre($chapitre); //permet à doctrine d'enregistrer dans la BD
        }

        for($n = 0; $n < mt_rand(1,7) ; $n++ ){
            $comment = new Comment();
            $comment->setPseudo($faker->name())
                    ->setEmail($faker->email())
                    ->setContent($faker->text(150))
                    ->setCreatedAt($faker->dateTimeBetween('-3 month','now'))
                     ;
    
            $manager ->persist($comment);
            $chapitre->addComment($comment); //permet à doctrine d'enregistrer dans la BD
           }
         $manager->persist($niveau);
     }

        $manager->flush();
    }
}
