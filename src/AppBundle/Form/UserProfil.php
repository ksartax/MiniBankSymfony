<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 01.05.2017
 * Time: 18:14
 */

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfil extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email', null, [
               'attr' => [
                   'disabled' => 'disabled'
               ],
                'label' => 'Email'
            ])
            ->add('firstname',null,[
                'attr' => [
                    'disabled' => 'disabled'
                ],
                'label' => 'Imie'
            ])
            ->add('lastname', null, [
                'attr' => [
                    'disabled' => 'disabled'
                ],
                'label' => 'Nazwisko'
            ])
            ->add('join_data',DateType::class,[
                'attr' => [
                    'disabled' => 'disabled'
                ],
                'label' => 'Konto stworzone'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}