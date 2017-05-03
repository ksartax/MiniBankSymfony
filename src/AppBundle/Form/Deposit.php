<?php
/**
 * Created by PhpStorm.
 * User: Damian Stępniak
 * Date: 01.05.2017
 * Time: 23:18
 */

namespace AppBundle\Form;

use AppBundle\Entity\DepositIntoAccount;
use AppBundle\Entity\FinanceAccountUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Deposit extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', null, [
                'attr' => [
                  'autofocus' => true,
                  'placeholder' => 'Kwota do wpłaty*'
                ],
                'label' => 'Kwota wpłaty',
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DepositIntoAccount::class,
        ]);
    }

}