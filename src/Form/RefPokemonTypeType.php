<?php

namespace App\Form;

use App\Entity\RefPokemonType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefPokemonTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type2')
            ->add('nom')
            ->add('evolution')
            ->add('starter')
            ->add('typeCourbeNiveau')
            ->add('type1')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RefPokemonType::class,
        ]);
    }
}
