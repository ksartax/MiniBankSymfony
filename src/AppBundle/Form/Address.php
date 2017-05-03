<?php

namespace AppBundle\Form;

use AppBundle\Entity\AddressUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Address extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('city', null, [
                'attr' => [
                    'autofocus' => true,
                    'maxlength' => 25
                ],
                'label' => 'Miasto',
                'required' => true
            ])
            ->add('street', null, [
                'attr' => [
                    'maxlength' => 25
                ],
                'label' => 'Ulica',
                'required' => true
            ])
            ->add('home_nr', null, [
                'attr' => [
                    'maxlength' => 25
                ],
                'label' => 'Nr Domu',
                'required' => true
            ])
            ->add('post_code', null, [
                'attr' => [
                    'maxlength' => 25
                ],
                'label' => 'Kod Pocztowy',
                'required' => true
            ])
            ->add('country', null, [
                'attr' => [
                    'maxlength' => 25,
                ],
                'label' => 'Kraj',
                'required' => true
            ])
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddressUser::class,
        ]);
    }

}