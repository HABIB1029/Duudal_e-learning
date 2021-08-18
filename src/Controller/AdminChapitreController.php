<?php

namespace App\Controller;

use App\Entity\Chapitre;;
use App\Form\ChapitreType;
use App\Repository\ChapitreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminChapitreController extends AbstractController
{
    public function __construct(ChapitreRepository $chapitre, EntityManagerInterface $manager)
    {
        $this->chapitre = $chapitre;
        $this->manager = $manager;
    }
    
    #[Route('home/admin', name: 'app_admin')]
    public function admin(): Response
    {
        $chapitre = $this->chapitre->findAll();
        return $this->render('admin_chapitre/admin.html.twig', [
            'chap'=> $chapitre,
        ]);
        
    
    }

    #[Route('/admin/new', name: 'app_admin.new', methods: ['GET' , 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $chap = new Chapitre();
        $form = $this->createForm( ChapitreType::class, $chap); 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $video = $form->get('videoExtension')->getData();
            if($video){
                 //création d'un nom pour l'image avec l'extension récupérée
            $videoName = md5(uniqid()) . '.' . $video->guessExtension();
            //on déplace l'image dans le répertoire cover_image_directory avec le nom qu'on nn$annonce crée
            $video->move(
                $this->getParameter('video_extension_directory'),
                $videoName
            );
            // on enregistre le nom de l'image dans la base de données
            
            $chap->setvideoExtension($videoName);
            }
            
            $doc = $form->get('documentExtension')->getData();
            if($doc){
                //création d'un nom pour l'image avec l'extension récupérée
           $docName = md5(uniqid()) . '.' . $doc->guessExtension();
           //on déplace l'image dans le répertoire cover_image_directory avec le nom qu'on nn$annonce crée
           $doc->move(
               $this->getParameter('document_extension_directory'),
               $docName
           );
           $chap->setDocumentExtension($docName);
           }

            $manager->persist($chap);
            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('admin_chapitre/new.html.twig', [
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
            $video = $form->get('videoExtension')->getData();
            if($video){
                 //création d'un nom pour l'image avec l'extension récupérée
            $videoName = md5(uniqid()) . '.' . $video->guessExtension();
            //on déplace l'image dans le répertoire cover_image_directory avec le nom qu'on nn$annonce crée
            $video->move(
                $this->getParameter('video_extension_directory'),
                $videoName
            );
            // on enregistre le nom de l'image dans la base de données
            
            $chap->setvideoExtension($videoName);
            }
            //repup
            $doc = $form->get('documentExtension')->getData();
            //création d'un nom pour l'image avec l'extension récupérée
            $docName = md5(uniqid()) . '.' . $doc->guessExtension();
            //on déplace l'image dans le répertoire cover_image_directory avec le nom qu'on nn$annonce crée
            $doc->move(
                $this->getParameter('cover_image_directory'),
                $docName
            );
            // on enregistre le nom de l'image dans la base de données
            $chap->setDocumentExtension($docName);

            $this->manager->flush();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin_chapitre/edit.html.twig', [
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
