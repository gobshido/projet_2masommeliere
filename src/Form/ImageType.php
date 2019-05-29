<?php

namespace App\Form;

use App\Entity\Image;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, array(
                'label'=>'image',
                'required'=>false
            ))
            ->add('alt', CKEditorType::class, array(
                'config'=>array(
                    'uiColor'=>'#A60815',
                    'toolbar'=>'full'
                )
            ))
            ->add('credit', CKEditorType::class, array(
                'config'=>array(
                    'uiColor'=>'#A60815',
                    'toolbar'=>'full'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
