<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\IsGrantedListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
		$user=$this->getUser();
/*  		if($this->isGranted('ROLE_USER')){
			echo '<pre>';
			print_r($user->getRoles());
			echo '</pre>';die;
		}else{
			echo 'Pas de role';die;
		} */
        return $this->render('accueil/index.html.twig', [
        ]);
    }
}
