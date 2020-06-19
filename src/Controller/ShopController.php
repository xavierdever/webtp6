<?php

namespace App\Controller;

use App\Form\PokemonType;
use App\Form\UserType;
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
class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request, PokemonRepository $pokeRepository)
    {
        $others_pokemons = $pokeRepository->getAvailableForSale($this->getUser()->getId());
        $my_pokemons = $pokeRepository->getMyPokemonsOnSale($this->getUser()->getId());

        return $this->render('pokemon/pokemonshop.html.twig', [
            'others_pokemons' => $others_pokemons,
            'my_pokemons' => $my_pokemons]);
    }

    /**
     * @Route("/shop/{idp}", name="buy")
     */
    public function buy(Pokemon $pokemon, PokemonRepository $pokeRepository)
    {
        $dresseur = $this->getDoctrine()->getRepository(User::class)->find($this->getUser()->getId());


        if ($dresseur->getPieces() >= $pokemon->getPrixVente()) {
            $newStock = $dresseur->getPieces() - $pokemon->getPrixVente();
            $pokeRepository->buyPokemon($dresseur->getId(), $pokemon->getDresseurid() ,$newStock, $pokemon->getPrixVente(), $pokemon->getIdp());

            return $this->render('pokemon/buy_success.html.twig',[
                'pokemon' => $pokemon
            ]);
        }
        return $this->render('pokemon/buy_error.html.twig', [
            'error' => 'Pas assez de pièces'
        ]);


    }
}
