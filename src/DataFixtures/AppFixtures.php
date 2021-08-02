<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cours;
use App\Entity\Video;
use App\Entity\Niveau;
use App\Entity\Comment;
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
         for ($i = 0; $i < 9 ; $i++){
 
         $niveau = new Niveau();
         $niveau->setTitle($faker->sentence(3, false));
         $niveau->setCreatedAt($faker->dateTimeBetween('-3 month','now'));
         $manager ->persist($niveau);

         for($j = 0; $j < 3 ; $j++ ){
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
         
         for($k = 0; $k < 6 ; $k++ ){
         $document = new Document();
         $document->setTitle($faker->sentence(3, false))
                ->setDocxExtension( "http://exo7.emath.fr/ficpdf/fic00020.pdf")
                ->setDescription($faker->sentence(3, False))
                ->setIsAvailable(mt_rand(0, 1))
                ->setCeatedAt($faker->dateTimeBetween('-3 month','now'))
                ->setSlug($slugger->slugify($document->getTitle()));
                  ;
 
         $manager ->persist($document);
         $cours->adddocument($document); //permet à doctrine d'enregistrer dans la BD
        }
        
        for($l = 0; $l < 6 ; $l++ ){
         $video = new Video();
         $video->setTitle($faker->sentence(3, false)) 
                ->setVideoExtension("https://www.youtube.com/embed/v64KOxKVLVg")
                 ->setDescription($faker->sentence(3, False))
                 ->setIsAvailable(mt_rand(0, 1))
                 ->setCreatedAt($faker->dateTimeBetween('-3 month','now'))
                 ->setSlug($slugger->slugify($video->getTitle()));
                  ;
 
            $manager ->persist($video);
            $cours->addvideo($video); //permet à doctrine d'enregistrer dans la BD
            }

        for($n = 0; $n < mt_rand(1,7) ; $n++ ){
            $comment = new Comment();
            $comment->setPseudo($faker->name())
                    ->setEmail($faker->email())
                    ->setContent($faker->text(150))
                    ->setCreatedAt($faker->dateTimeBetween('-3 month','now'))
                     ;
    
            $manager ->persist($comment);
            $document->addComment($comment);
            $video->addComment($comment); //permet à doctrine d'enregistrer dans la BD
           }
         $manager->persist($niveau);
     }

        $manager->flush();
    }
}
