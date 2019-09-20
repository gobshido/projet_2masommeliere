<?php

namespace App\Form;

use App\Entity\Prix;
use App\Entity\Targetprice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('targetprices')
//        ,
//                CollectionType::class, array(
//                'entry_type'=>TargetpriceType::class, array(
//                )
//            ))
            ->add('isDesactivated')
            ->add('value')
//            ->add('devise')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
