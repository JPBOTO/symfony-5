<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Collaborateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class CollaborateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code',TextType::class)
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('fonction')
            ->add('adresse')
            ->add('mail')
            ->add('client',EntityType::class,[
                'class'=>Client::class,
                'choice_label'=>'nomSociete',
                'mapped'=>true,
                'expanded'=>false,
                'multiple'=>false,                
            ],
           

            
            
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
