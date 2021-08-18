<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Controller\NiveauType;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NiveauController extends AbstractController
{
    private $repository;

    /**
    * var NiveauRepository
    */
    public function __construct(NiveauRepository $repo, EntityManagerInterface $manager)
    {
        $this->repository = $repo;
        $this->manager = $manager;
    }

    /**
    * @Route("/new", name="niveau_new", methods="GET|POST")
    */
    public function new(Request $request): Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($niveau);
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('niveau/new.html.twig', [
            'niv' => $niveau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="niveau_edit")
     * @param  Niveau $niveau
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Niveau $niveau, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm( NiveauType::class, $niveau); 
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($niveau);
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('niveau/edit.html.twig', [
            'niv' => $niveau,
            'form' => $form->createView(),
        ]);
    }

}
