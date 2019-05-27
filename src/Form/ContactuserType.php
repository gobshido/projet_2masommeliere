<?php

namespace App\Form;

use App\Entity\Contactuser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactuserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone')
            ->add('jourOuverture')
            ->add('heureOuverture')
            ->add('heureFermeture')
            ->add('presentation', TextareaType::class, array(
                'attr'=>array(
                    'rows'=>'6',
                    'cols'=>'100'
                )
            ))
            ->add('image', ImageType::class, array(
                "required"=>false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contactuser::class,
        ]);
    }
}
