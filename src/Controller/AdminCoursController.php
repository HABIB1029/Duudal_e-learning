<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Form\ChapitreType;
use App\Repository\ChapitreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    /**
     * @Route("cours/admin/new", name="app_admin.new")
     * @param Chapitre $chap
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function new(Request $request, EntityManagerInterface $manager){

        $chap = new Chapitre();
        $form = $this->createForm(ChapitreType::class, $chap);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($chap); 
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin_cours/new.html.twig', [
            'chap' => $chap,
            'form' => $form->createView(),
        ]);
     }

    /**
     * @Route("cours/admin/{id}", name="app_admin.edit")
     * @param Chapitre $chap
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

     public function edit(Chapitre $chap, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(ChapitreType::class, $chap);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin_cours/edit.html.twig', [
            'chap' => $chap,
            'form' => $form->createView(),
        ]);
     }

     /**
     * @Route("cours/admin/{id}/delete", name="app_admin.delete")
     * @param Chapitre $chap
     * @return RedirectResponse
     */
    public function delete(Chapitre $chap): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($chap);
        $em->flush();

        return $this->redirectToRoute("app_admin");
    }
}
