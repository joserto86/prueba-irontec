<?php

namespace App\Form;

use App\Entity\Strategy;
use App\Model\Shortener;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShortenerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class)
            ->add('strategy', EntityType::class, [
                'class' => Strategy::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
            ])
            ->add('hash', TextType::class)
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shortener::class,
            'crsf_protection' => false,
            // Configure your form options here
        ]);
    }
}
