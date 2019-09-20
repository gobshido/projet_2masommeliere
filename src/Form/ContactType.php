<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Cible;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'required'=>true
            ))
            ->add('lastname', TextType::class, array(
                'required'=>true
            ))
            ->add('firstname', TextType::class, array(
                'required'=>true
            ))
            ->add('message', TextareaType::class, array(
                'label' => 'Message'
            ))
            //ne pas mettre dans le form pour laisser le serveur mettre la date du jour
//            ->add('sent')
            ->add('category')
            ->add('cible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
