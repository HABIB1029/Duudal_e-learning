<?php

namespace App\Controller;

use App\Repository\ChapitreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCoursController extends AbstractController
{
    public function __construct(ChapitreRepository $chapitre, EntityManagerInterface $manager)
    {
        $this->chapitre = $chapitre;
        $this->manager = $manager;
    }
    
    /**
     * @Route("cours/admin", name="app_admin")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): Response
    {   
        $chap = $this->chapitre->findAll();
        return $this->render('admin_cours/index.html.twig', [
            'chap' => $chap,
        ]);
    }
}
