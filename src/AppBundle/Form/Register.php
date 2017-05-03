<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 02.05.2017
 * Time: 14:49
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class Register extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', null, [
            'label' => 'Email',
            'required' => true,
            'attr' => [
                'autofocus' => true
            ]
        ])
            ->add('firstname', null, [
                'label' => 'Imie',
                'required' => true
            ])
            ->add('lastname', null, [
                'label' => 'Nazwisko  ',
                'required' => true
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Haslo',
                'required' => true
            ])
            ->add('protect_code', null, [
                'label' => 'Kod bezpieczęstwa',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }


}