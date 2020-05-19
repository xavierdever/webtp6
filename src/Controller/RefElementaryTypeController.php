<?php

namespace App\Controller;

use App\Entity\RefElementaryType;
use App\Form\RefElementaryTypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ref/elementary/type")
 */
class RefElementaryTypeController extends AbstractController
{
    /**
     * @Route("/", name="ref_elementary_type_index", methods={"GET"})
     */
    public function index(): Response
    {
        $refElementaryTypes = $this->getDoctrine()
            ->getRepository(RefElementaryType::class)
            ->findAll();

        return $this->render('ref_elementary_type/index.html.twig', [
            'ref_elementary_types' => $refElementaryTypes,
        ]);
    }

    /**
     * @Route("/new", name="ref_elementary_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $refElementaryType = new RefElementaryType();
        $form = $this->createForm(RefElementaryTypeType::class, $refElementaryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($refElementaryType);
            $entityManager->flush();

            return $this->redirectToRoute('ref_elementary_type_index');
        }

        return $this->render('ref_elementary_type/new.html.twig', [
            'ref_elementary_type' => $refElementaryType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ref_elementary_type_show", methods={"GET"})
     */
    public function show(RefElementaryType $refElementaryType): Response
    {
        return $this->render('ref_elementary_type/show.html.twig', [
            'ref_elementary_type' => $refElementaryType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ref_elementary_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RefElementaryType $refElementaryType): Response
    {
        $form = $this->createForm(RefElementaryTypeType::class, $refElementaryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ref_elementary_type_index');
        }

        return $this->render('ref_elementary_type/edit.html.twig', [
            'ref_elementary_type' => $refElementaryType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ref_elementary_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RefElementaryType $refElementaryType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refElementaryType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($refElementaryType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ref_elementary_type_index');
    }
}
