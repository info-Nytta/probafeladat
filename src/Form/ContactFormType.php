<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class'=> 'mb-3 mt-3 form-control',
                    'placeholder' => 'Add meg a neved!',
                ),
                'required' => false,
                'label' => 'Név'
            ])
            ->add('email', EmailType::class, [
                'attr' => array(
                    'class'=> 'mb-3 mt-3 form-control',
                    'placeholder' => 'Add meg az email címed!',
                ),
                'required' => false,
                'label' => 'Email'
            ])
            ->add('msg', TextareaType::class, [
                'attr' => array(
                    'class'=> 'mb-3 mt-3 form-control',
                    'placeholder' => 'Tedd fel a kérdésed!',
                    'rows' =>5,
                ),
                'required' => false,
                'label' => 'Üzenet'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
