<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Module;
use App\Entity\Prestation;
use App\Entity\Prix;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cible')
            ->add('categorie', EntityType::class, array(
                'class'=>Categorie::class
            ))
            ->add('nom')
            ->add('description', TextareaType::class, array(
                'attr'=>array(
                    'rows'=>'6',
                    'cols'=>'100'
                )
            ))
            ->add('module', EntityType::class, array(
                'class'=>Module::class,
                'expanded'=>true,
                'multiple'=>true
            ))
            ->add('prix', CollectionType::class, array(
                'entry_type'=>Prix::class,
                'required'=>false,
                'label'=>'Prix particulier'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
