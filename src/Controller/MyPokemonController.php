<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;




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

    /**
     * @Route("/{idp}", name="my_pokemon_show", methods={"GET", "POST"})
     */
    public function show(Pokemon $pokemon): Response
    {
        return $this->render('pokemon/pokemondetail.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }

    /**
     * @Route("/{idp}/edit", name="my_pokemon_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pokemon $pokemon): Response
    {
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_my_pokemon');
        }

        return $this->render('pokemon/edit.html.twig', [
            'pokemon' => $pokemon,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{idp}", name="my_pokemon_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pokemon $pokemon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pokemon->getIdp(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pokemon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_my_pokemon');
    }


}