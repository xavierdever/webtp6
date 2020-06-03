<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PokemonRepository;
use App\Entity\User;
use App\Entity\Pokemon;
use App\Entity\RefPokemonType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CaptureType;




/**
* @Route("/")
*/
class CaptureController extends AbstractController
{
    /**
     * @Route("/capture_index", name="app_capture")
     */
    public function index(Request $request, PokemonRepository $pokeRepository)
    {
        $pokemon = new Pokemon();
        $dresseur = $this->getDoctrine()->getRepository(User::class)->findBy(['username' =>  $this->getUser()->getUsername()]);
        $dressId = $dresseur[0]->getId();
        $pokemons = $pokeRepository->getPokemonReadyForCapture($dressId);
        dump(isset($pokemons));
        dump(count($pokemons));

        if (count($pokemons) == 0) {
            return $this->render('pokemon/capture_error.html.twig', [
                                'error' => 'Aucun pokemons disponible pour la capture'
                            ]);
        }

        $choices = array();
        foreach ($pokemons as $poke) {
            $choices[$poke['idp']] = $poke['nom'];
        }
        dump($choices);
        $form = $this->createForm(CaptureType::class, $pokemon, array('availablePokemons' => $choices));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $zone =  dump($form->get('zone')->getData());
           $pokemonId = dump($form->get('pokemon')->getData());

           $list = $this->getDoctrine()->getRepository(RefPokemonType::class)->getPokemonsTypeByZone((int) $zone);


           $num = rand(0, count($list)-1);
           $entityManager = $this->getDoctrine()->getManager();
           $espece =  $list[$num];
           dump($espece);
           $newPokemon = new Pokemon();
           $newPokemon->setNom($espece['nom']);
           $newPokemon->setDresseurid($dressId);
           $newPokemon->setXp(0);
           $newPokemon->setNiveau(1);
           $newPokemon->setPrixVente(0);
           $date = new DateTime('0/0/0 0:0:0');
           $date->format('d/m/Y H:i:s');
           $newPokemon->setDerniereChasse($date);
           $newPokemon->setDernierEntrainement($date);
           $sexe = rand(0,1);
           if ($sexe == 1) {
                $newPokemon->setSexe('F');
           }
           else if ($sexe == 0) {
                $newPokemon->setSexe('M');
           }
           $newPokemon->setIdEspece($espece['id']);
           $entityManager->persist($newPokemon);
           $entityManager->flush();
           $pokeRepository->updateDerniereChasse($pokemonId);
            dump($newPokemon);
           return $this->render('pokemon/capture_success.html.twig', [
                               'pokemon' => $newPokemon
                           ]);
        }



        return $this->render('pokemon/capture.html.twig', [
                    'captureForm' => $form->createView() ]);
    }
}
