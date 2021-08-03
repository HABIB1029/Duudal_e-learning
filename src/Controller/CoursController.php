<?php

namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Comment;
use App\Repository\CoursRepository;
use App\Repository\ChapitreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoursController extends AbstractController
{
    private $repository;

    /**
    * var ChapitreRepository
    */
    public function __construct(ChapitreRepository $repo, EntityManagerInterface $manager)
    {
        $this->repository = $repo;
        $this->manager = $manager;
    }


    #[Route('/home/cours', name: 'app_cours')]
    /**
    * @Route'/home/cours', name='app_cours')
    * @param Chapitre $cours
    * @return Response
    */
    public function index(): Response
    {
        $cours = $this->repository->findAll();
        return $this->render('cours/index.html.twig', [
            'cours'=> $cours,
        ]);
    }

    /**
    * @Route("home/cours/{slug}", name="app_show", requirements={"slug": "[a-z0-9\-]*"})
    * @param Cours $cours
    * @return Response
    */
    public function show(Cours $cours, Request $request): Response
    {   
        $cours = $this->repository->findAll();
        return $this->render('cours/show.html.twig', [
            'cours'=> $cours,
        ]);
    }

    #[Route('/home/documents', name: 'app_document')]
    public function document(): Response
    {
        return $this->render('cours/document.html.twig', [
            'document' => 'documents',
        ]);
    }
    
    #[Route('/home/videos', name: 'app_video')]
    public function video(): Response
    {
        return $this->render('cours/video.html.twig', [
            'video' => 'videos',
        ]);
    } 
    
    #[Route('/home/cours/6eme', name: 'app_cours_6eme')]
    public function cours1(): Response
    {
        return $this->render('cours/cour1.html.twig', [
            'cour1' => 'cours1',
        ]);
    }

    #[Route('/home/cours/5eme', name: 'app_cours_5eme')]
    public function cours2(): Response
    {
        return $this->render('cours/cour2.html.twig', [
            'cour2' => 'cours2',
        ]);
    }

    #[Route('/home/cours/4eme', name: 'app_cours_4eme')]
    public function cours3(): Response
    {
        return $this->render('cours/cour3.html.twig', [
            'cour3' => 'cours3',
        ]);
    }

    #[Route('/home/cours/3eme', name: 'app_cours_3eme')]
    public function cours4(): Response
    {
        return $this->render('cours/cour4.html.twig', [
            'cour4' => 'cours4',
        ]);
    }

    #[Route('/home/cours/2nde', name: 'app_cours_2nde')]
    public function cours5(): Response
    {
        return $this->render('cours/cour5.html.twig', [
            'cour5' => 'cours5',
        ]);
    }
    #[Route('/home/cours/1ereS', name: 'app_cours_1ereS')]
    public function cours6(): Response
    {
        return $this->render('cours/cour6.html.twig', [
            'cour6' => 'cours6',
        ]);
    }

    #[Route('/home/cours/1ereL', name: 'app_cours_1ereL')]
    public function cour7(): Response
    {
        return $this->render('cours/cour7.html.twig', [
            'cour7' => 'cours7',
        ]);
    }

    #[Route('/home/cours/TleS', name: 'app_cours_TleS')]
    public function cours8(): Response
    {
        return $this->render('cours/cour8.html.twig', [
            'cour8' => 'cours8',
        ]);
    }

    #[Route('/home/cours/TleL', name: 'app_cours_TleL')]
    public function cours9(): Response
    {
        return $this->render('cours/cour9.html.twig', [
            'cour9' => 'cours9',
        ]);
    }

    
    
}
