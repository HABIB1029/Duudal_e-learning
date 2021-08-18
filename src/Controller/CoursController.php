<?php

namespace App\Controller;


use App\Entity\Cours;
use App\Entity\Niveau;
use App\Controller\CoursType;
use App\Controller\NiveauType;
use App\Repository\CoursRepository;
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
    public function __construct(CoursRepository $repo, EntityManagerInterface $manager)
    {
        $this->repository = $repo;
        $this->manager = $manager;
    }
 
    // /**
    //  * @Route("/new", name="cours_new")
    //  * @param  Cours $cours
    //  * @param Request $request
    //  * @return \Symfony\Component\HttpFoundation\Response
    //  */
    // public function new(Request $request, EntityManagerInterface $manager): Response
    // {
    //     $cours = new Cours();
    //     $form = $this->createForm( CoursType::class, $cours); 
    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()){
    //         $this->manager->persist($cours);
    //         $this->manager->flush();
    //         return $this->redirectToRoute('app_admin');
    //     }
    //     return $this->render('cours/new.html.twig', [
    //         'cours' => $cours,
    //         'form' => $form->createView(),
    //     ]);
    // }

/**
 * @Route("/new/{id}", name="cours_new", methods="GET|POST")
 */
public function new(Request $request, Niveau $niveau): Response
{
    $cours = new Cours();
    // already set a cours, so as to not need add that field in the form (in ChapitreType)
    $cours->setNiveau($niveau);

    $form = $this->createForm(CoursType::class, $cours);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $this->manager->persist($cours);
        $this->manager->flush();
        return $this->redirectToRoute('app_admin');
    }
    return $this->render('cours/new.html.twig', [
        'cours' => $cours,
        'form' => $form->createView(),
    ]);
}

    /**
     * @Route("/{id}/edit", name="cours_edit")
     * @param  Cours $cours
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm( CoursType::class, $cours); 
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($cours);
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('cours/edit.html.twig', [
            'cours' => $cours,
            'form' => $form->createView(),
        ]);
    }
    
}
