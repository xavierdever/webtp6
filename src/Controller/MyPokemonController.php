<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MyPokemonController extends AbstractController
{
    /**
     * @Route("/mypokemon", name="app_my_pokemon")
     */
    public function index(PokemonRepository $pokemonRepository)
    {

        $pokemons = $pokemonRepository->getPokemonByDresseurId($this->getUser()->getId());


        return $this->render('pokemon/mypokemon.html.twig', [
            'pokemons' => $pokemons]);
    }


}