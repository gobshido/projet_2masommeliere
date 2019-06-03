<?php

namespace App\Form;

use App\Entity\Prix;
use App\Entity\Targetprice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
            ->add('devise')
            ->add('isDesactivated')
            ->add('targetprices', CollectionType::class, array(
                'entry_type'=>TargetpriceType::class
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
