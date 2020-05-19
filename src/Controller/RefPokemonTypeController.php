<?php

namespace App\Controller;

use App\Entity\RefPokemonType;
use App\Form\RefPokemonTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ref_pokemon_type")
 */
class RefPokemonTypeController extends AbstractController
{
    /**
     * @Route("/", name="ref_pokemon_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $refPokemonTypes = $this->getDoctrine()
            ->getRepository(RefPokemonType::class)
            ->findAll();

        return $this->render('ref_pokemon_type/index.html.twig', [
            'ref_pokemon_types' => $refPokemonTypes,
        ]);
    }

    /**
     * @Route("/new", name="ref_pokemon_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $refPokemonType = new RefPokemonType();
        $form = $this->createForm(RefPokemonTypeType::class, $refPokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refPokemonType);
            $entityManager->flush();

            return $this->redirectToRoute('ref_pokemon_type_index');
        }

        return $this->render('ref_pokemon_type/new.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ref_pokemon_type_show", methods={"GET"})
     */
    public function show(RefPokemonType $refPokemonType): Response
    {
        return $this->render('ref_pokemon_type/show.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ref_pokemon_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RefPokemonType $refPokemonType): Response
    {
        $form = $this->createForm(RefPokemonTypeType::class, $refPokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ref_pokemon_type_index');
        }

        return $this->render('ref_pokemon_type/edit.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ref_pokemon_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RefPokemonType $refPokemonType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refPokemonType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refPokemonType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ref_pokemon_type_index');
    }
}
