<?php

namespace App\Controller;

use App\Entity\Youtube;
use App\Form\YoutubeType;
use App\Repository\YoutubeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class YoutubeController extends AbstractController
{
    /**
     * @Route("/youtube", name="app_youtube")
     */
    public function index(Request $request,EntityManagerInterface $em,YoutubeRepository $youtubeRepository): Response
    {
        $youtube = new Youtube();
        $form=$this->createForm(YoutubeType::class,$youtube);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($youtube);
            $em->flush();
            return $this->redirectToRoute('app_youtube');
        }
        return $this->render('youtube/index.html.twig', [
           'form'=>$form->createView(),
           'youtubes'=>$youtubeRepository->findAll(),
        ]);
    }
    /**
     * @Route("/video/{id}", name="app_video")
     */
    public function video(Youtube $youtube): Response
    {

        return $this->render('youtube/video.html.twig', [
           'url'=>$youtube->getUrl(),
           'name'=>$youtube->getName(),
        ]);
    }    
}
