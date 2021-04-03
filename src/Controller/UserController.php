<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/modif/{id}", name="user_modif")
     */
    public function modif(Request $request,UserRepository $userRepository,User $user,RoleRepository $roleRepository): Response
    {
        
        $form=$this->createForm(UserType::class,$user);
        $user_roles=$user->getRoles();
        foreach($user_roles as $user_role){
            $datas[$user_role]=$user_role;
        }
        $roles=$roleRepository->findAll();
        $choices=[];
        foreach($roles as $role){
            $code=$role->getCode();
            $choices[$code]=$code;
        }

        $form	
        ->add('roles',ChoiceType::class,[
            'choices'=>$choices,
            'multiple'=>true,
            'expanded'=>false,
            
        ])
        ->add('dateCreation', DateType::class, [
            // renders it as a single text box
            'widget' => 'single_text',
            'mapped'=>true,
            'required'=>true,
        ]);               		

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // $date=$request->get('data')['publishedAt'];
            // echo $date;die;
           $em=$this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();



        }        
        return $this->render('user/formUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
