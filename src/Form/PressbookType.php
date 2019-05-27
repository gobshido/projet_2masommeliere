<?php

namespace App\Form;

use App\Entity\Pressbook;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PressbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url')
            ->add('brochure', FileType::class, array(
                'label'=>'Brochure (PDF file)',
                'required'=>false
            ))
            ->add('image', ImageType::class, array(
                'required'=>false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pressbook::class,
        ]);
    }
}
