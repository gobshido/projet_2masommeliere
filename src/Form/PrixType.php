<?php

namespace App\Form;

use App\Entity\PriceType;
use App\Entity\Prix;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
            ->add('devise')
            ->add('isActivated')
            ->add('typePrix', EntityType::class, array(
                'class'=> PriceType::class,
                'disabled' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
