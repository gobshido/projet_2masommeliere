<?php

namespace App\Form;

use App\Entity\Actualite;
use App\Entity\Module;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description', CKEditorType::class, array(
                'config'=>array(
                    'uiColor'=>'#A60815',
                    'toolbar'=>'full'
                )
            ))
            ->add('module', EntityType::class, array(
                'class'=>Module::class,
                'expanded'=>true,
                'multiple'=>true
            ))
            ->add('date')
            ->add('heure')
            ->add('lieu')
            ->add('image', ImageType::class, array(
                "required"=>false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actualite::class,
        ]);
    }
}
