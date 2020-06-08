<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\RefElementaryType;
use App\Entity\RefPokemonType;
use App\Form\PokemonType;
use App\Repository\EntityRepository;
use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



/**
 * @Route("/my_pokemon")
 */
class MyPokemonController extends AbstractController
{
    /**
     * @Route("/mypokemon_index", name="app_my_pokemon")
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
        $espece = $this->getDoctrine()->getRepository(RefPokemonType::class)->find($pokemon->getIdEspece());
        $typeEntity1 = $this->getDoctrine()->getRepository(RefElementaryType::class)->find($espece->getType1());
        $type1 = $typeEntity1->getLibelle();
        if ($espece->getType2()) {
            $typeEntity2 = $this->getDoctrine()->getRepository(RefElementaryType::class)->find($espece->getType2());
            $type2 = $typeEntity2->getLibelle();
        }
        else
            $type2 = null;
        $derniereChasse = $pokemon->getDerniereChasse()->format('d/m/Y H:i:s');
        $dernierEntrainement = $pokemon->getDernierEntrainement()->format('d/m/Y H:i:s');

        return $this->render('pokemon/pokemondetail.html.twig', [
            'pokemon' => $pokemon,
            'espece' => $espece,
            'type1' => $type1,
            'type2' => $type2,
            'dernierEntrainement' => $dernierEntrainement,
            'derniereChasse' => $derniereChasse,
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
     * @Route("/{idp}/train", name="my_pokemon_train", methods={"GET","POST"})
     */
    public function train(Request $request, Pokemon $pokemon, PokemonRepository $pokeRepository)
    {
        dump("LIGNE 1");
        $espece = $this->getDoctrine()->getRepository(RefPokemonType::class)->find($pokemon->getIdEspece());

        $courbeNiveau = $espece->getTypeCourbeNiveau();

        dump($courbeNiveau);

        $niveauActuel = $pokemon->getNiveau();
        $niveauSuivant = $niveauActuel + 1;
        $derniereChasse = $pokemon->getDerniereChasse()->format('d/m/Y H:i:s');
        $dernierEntrainement = $pokemon->getDernierEntrainement()->format('d/m/Y H:i:s');


        {#GERER LA VERIFICATION#}


            switch ($courbeNiveau) {
                case "R":
                    $pallierNiveauSuivant = 0.8 * (pow($niveauSuivant, 3));
                    break;
                case "M":
                    $pallierNiveauSuivant = pow($niveauSuivant, 3);
                    break;
                case "P":
                    $pallierNiveauSuivant = 1.2 * (pow($niveauSuivant, 3)) - 15 * (pow($niveauSuivant, 2)) + 100 * $niveauSuivant - 140;
                    break;
                case "L":
                    $pallierNiveauSuivant = 1.25 * (pow($niveauSuivant, 3));
                    break;
            }


            $newXp = rand(10, 30);
            $pokemon->setXp($pokemon->getXp() + $newXp);
            $pokeRepository->updateXp($pokemon->getIdp(), $pokemon->getXp());

            if ($pokemon->getXp() >= $pallierNiveauSuivant) {
                $pokemon->setNiveau($niveauSuivant);
                $pokeRepository->updateNiveau($pokemon->getIdp(), $niveauSuivant);
            }

            $nextLevel = $pallierNiveauSuivant - $pokemon->getXp();
            $pokeRepository->updateDernierEntrainement($pokemon->getIdp());


                return $this->render('pokemon/entrainement_success.html.twig', [
                    'pokemon' => $pokemon,
                    'typecourbe' => $courbeNiveau,
                    'xpgagne' => $newXp,
                    'nextLevel' => $nextLevel,
                    'dernierEntrainement' => $dernierEntrainement,
                    'derniereChasse' => $derniereChasse,
                ]);
            }
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