<?php

namespace App\Form;

use App\Entity\Contactuser;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
            ->add('presentation', CKEditorType::class, array(
                'config'=>array(
                    'uiColor'=>'#A60815',
                    'toolbar'=>'full'
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
