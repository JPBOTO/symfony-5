<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Collaborateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollaborateurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('fonction')
            ->add('adresse')
            ->add('mail')
            ->add('clients',EntityType::class,[
                'label'=>'Clients associés:',
                'class'=>Client::class,
                'choice_label'=>'nomSociete',
                'multiple'=>true,
                'mapped'=>true,
                'required'=>false,
            ])
            ->add('Valider',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn btn-primary'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Collaborateur::class,
        ]);
    }
}
