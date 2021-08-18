<?php

namespace App\Controller;

use App\Entity\Chapitre;
use App\Entity\Cours;
use App\Form\ChapitreType;
use App\Repository\ChapitreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChapitreController extends AbstractController
{
    /**
    * var ChapitreRepository
    */
    public function __construct(ChapitreRepository $repo, EntityManagerInterface $manager)
    {
        $this->repository = $repo;
        $this->manager = $manager;
    }

    
    #[Route('/home/cours', name: 'app_cours')]
    public function index(): Response
    {
        $chap = $this->repository->findAll();
        return $this->render('chapitre/index.html.twig', [
            'chap'=> $chap,
        ]);
    }

    
    /**
    * @Route("show/{slug}", name="app_show", requirements={"slug": "[a-z0-9\-]*"})
    * @param Chapitre $chap
    * @return Response
    */
    public function show(Chapitre $chap, Request $request): Response
    {   
        $chap = $this->repository->findAll();
        return $this->render('chapitre/show.html.twig', [
            'chap'=> $chap,
        ]);
    }

/**
* @Route("/new/{id}", name="chapitre_new", methods="GET|POST")
*/
public function new(Request $request, Cours $cours): Response
{
    $chap = new Chapitre();
    // already set a cours, so as to not need add that field in the form (in ChapitreType)
    $chap->setCours($cours);

    $form = $this->createForm(ChapitreType::class, $chap);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
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

        $this->manager->persist($chap);
        $this->manager->flush();
        return $this->redirectToRoute('app_admin');
    }
    return $this->render('admin_chapitre/new.html.twig', [
        'chap' => $chap,
        'form' => $form->createView(),
    ]);
}
    

    #[Route('/home/documents', name: 'app_document')]
    public function document(): Response
    {
        $doc = $this->repository->findAll();
        return $this->render('chapitre/document.html.twig', [
            'docs' => $doc,
        ]);
    }
    
    #[Route('/home/videos', name: 'app_video')]
    public function video(): Response
    {
        $video = $this->repository->findAll();
        return $this->render('chapitre/video.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/home/6eme', name: 'app_cours_6eme')]
    public function cours1(Request $request, EntityManagerInterface $manager): Response
    {   
        $cour1 = $this->repository->findAll();
        return $this->render('chapitre/cour1.html.twig', [
            'cour1' => $cour1,
        ]);
    }

    #[Route('/home/5eme', name: 'app_cours_5eme')]
    public function cours2(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour2.html.twig', [
            'cour2' => $niveau,
        ]);
    }

    #[Route('/home/4eme', name: 'app_cours_4eme')]
    public function cours3(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour3.html.twig', [
            'cour3' => $niveau,
        ]);
    }

    #[Route('/home/3eme', name: 'app_cours_3eme')]
    public function cours4(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour4.html.twig', [
            'cour4' => $niveau,
        ]);
    }

    #[Route('/home/2nde', name: 'app_cours_2nde')]
    public function cours5(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour5.html.twig', [
            'cour5' => $niveau,
        ]);
    }
    #[Route('/home/1ereS', name: 'app_cours_1ereS')]
    public function cours6(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour6.html.twig', [
            'cour6' => $niveau,
        ]);
    }

    #[Route('/home/1ereL', name: 'app_cours_1ereL')]
    public function cour7(Chapitre $niveau): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour7.html.twig', [
            'cour7' => $niveau,
        ]);
    }

    #[Route('/home/TleS', name: 'app_cours_TleS')]
    public function cours8(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour8.html.twig', [
            'cour8' => $niveau,
        ]);
    }

    #[Route('/home/TleL', name: 'app_cours_TleL')]
    public function cours9(): Response
    {
        $niveau = $this->repository->findAll();
        return $this->render('chapitre/cour9.html.twig', [
            'cour9' => $niveau,
        ]);
    }
}
