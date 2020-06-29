<?php

namespace App\Form;

use App\Entity\Embedded\Identity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentityAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, [
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('lastname',TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('birth', DateType::class, [
                'format' => 'd / M / y',
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date de naissance ( JJ / MM / AAAA )',
                    'class' => 'input-date-naiss'
                ],
                'years' => range(date('Y'), 1940)
            ])
            ->add('address',TextType::class, [
                'attr' => [
                    'placeholder' => 'Adresse postale'
                ]
            ])
            ->add('complement',TextType::class, [
                'attr' => [
                    'placeholder' => 'Complément d\'adresse'
                ],
                'required' => false
            ])
            ->add('cp',TextType::class, [
                'attr' => [
                    'placeholder' => 'Code postal',
                    'class' => 'input-cp'
                ]
            ])
            ->add('city',TextType::class, [
                'attr' => [
                    'placeholder' => 'Ville'
                ]
            ])
            ->add('country',TextType::class, [
                'attr' => [
                    'placeholder' => 'Pays'
                ]
            ])
            ->add('phone',TextType::class, [
                'attr' => [
                    'placeholder' => 'Téléphone',
                    'class' => 'input-phone'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Identity::class
        ]);
    }
}
