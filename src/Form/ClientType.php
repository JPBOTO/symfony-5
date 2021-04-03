<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeClient',TextType::class,[
                'label'=>'Code client +++++++:',
                'label_attr'=>[
                    'class'=>'gras lab30 obligatoire'
                ],
                'attr'=>[
                    'class'=>'w60 form-control',
                ]

            ])
            ->add('formeJuridique',ChoiceType::class,[
                'expanded'=>true,
                'multiple'=>false,
                'required'=>false,

                'label'=>'Forme Juridique:',
                'label_attr'=>[
                    'class'=>'gras lab30 obligatoire'
                ],
                'attr'=>[
                    'class'=>'w60 form-control',
                ],
                'choices'=>array(
                    'SARL' =>'SARL',
                    'URL'  =>'URL'  ,
                    'SA'   =>'SA'    ,
                    'SAS'  =>'SAS'  ,                                                            
                    'SASU' =>'SASU',    
                ),


            ])            
            ->add('nomSociete')
            ->add('siret')
            ->add('adresse')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
