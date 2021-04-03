<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/article", name="article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index",methods={"GET", "POST"})
     */
    public function index(Request $request): Response {
        $em=$this->getDoctrine()->getManager();
        $article=$em->getRepository('App\Entity\Article')->find(1);
        // $form=$this->createFormBuilder($article)
        //     ->add('code',TextType::class,array(
        //         'choice_label'=>'Code article'
        //     ))
        //     ->add("desigantion",TextType::class)
        //     ->add("prixUnitaire",TypeTextType::class);
        // $form->getForm();
        $form=$this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $em->persist($article);
                $em->flush();
            }
        }

        return $this->render('article/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
