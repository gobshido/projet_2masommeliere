<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Prestation;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cible')
            ->add('nom')
            ->add('modules', EntityType::class, array(
                'class'=>Module::class,
                'expanded'=>true,
                'multiple'=>true
            ))
            ->add('description', CKEditorType::class, array(
                'config'=>array(
                    'uiColor'=>'#A60815',
                    'toolbar'=>'full'
                )
            ))
            ->add('prices', CollectionType::class, array(
                'entry_type' => PrixType::class
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
