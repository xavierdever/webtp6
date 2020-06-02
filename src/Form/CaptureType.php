<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\ZoneCapture;
use http\Env\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class CaptureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('pokemon', ChoiceType::class, [
               'mapped' => false,
               'choices' => array_flip($options['availablePokemons']),
               'constraints' => [new Length(['min' => 1])],
               'label' => 'Choisissez le pokemon disponible pour vous aider'

           ])
           ->add('zone', ChoiceType::class, [
               'mapped' => false,
               'choices' => [
                   'Montagne' => 1,
                   'Prairie' => 2,
                   'Ville' => 3,
                   'Forêt' => 4,
                   'Plage' => 5,
               ],
               'label' => 'Choisissez la zone de capture'
           ])
       ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
            'availablePokemons' => null

        ]);
    }
}
