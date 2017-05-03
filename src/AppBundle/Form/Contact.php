<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 01.05.2017
 * Time: 18:04
 */

namespace AppBundle\Form;


use AppBundle\Entity\ContactUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Contact extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone', null, [
                'attr' => [
                    'autofocus' => true,
                    'maxlength' => 25,
                    'placeholder' => 'nr telefonu*'
                ],
                'label' => 'Telefon',
                'required' => true
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactUser::class,
        ]);
    }

}