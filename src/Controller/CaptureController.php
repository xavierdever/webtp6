<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PokemonRepository;
use App\Entity\User;
use App\Entity\Pokemon;
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
        $choices = array();
        dump($pokemons);
        foreach ($pokemons as $poke) {
            dump($poke);
            $idp = $poke['nom'];
            $choices[$idp] = $poke['nom'];
        }
        dump($choices);
        $form = $this->createForm(CaptureType::class, $pokemon, $choices);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($pokemon);
            dump($form->get('zone'));
        }


        return $this->render('pokemon/capture.html.twig', [
                    'captureForm' => $form->createView() ]);
    }
}
