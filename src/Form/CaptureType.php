<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\ZoneCapture;
use http\Env\Response;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaptureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : Response
    {
       $this->availablePokemons = $options['availablePokemons'];
       $builder
           ->add('pokemon_capture', ChoiceType::class, [
               'mapped' => false,
               'choices' => $this->availablePokemons
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
