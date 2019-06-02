<?php

namespace App\Controller;

use App\Entity\Cible;
use App\Form\CibleType;
use App\Repository\CibleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cible")
 */
class CibleController extends AbstractController
{
    /**
     * @Route("/", name="cible_index", methods={"GET"})
     */
    public function index(CibleRepository $cibleRepository): Response
    {
        return $this->render('cible/index.html.twig', [
            'cibles' => $cibleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cible_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cible = new Cible();
        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cible);
            $entityManager->flush();

            return $this->redirectToRoute('cible_index');
        }

        return $this->render('cible/new.html.twig', [
            'cible' => $cible,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cible_show", methods={"GET"})
     */
    public function show(Cible $cible): Response
    {
        return $this->render('cible/show.html.twig', [
            'cible' => $cible,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cible_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cible $cible): Response
    {
        $form = $this->createForm(CibleType::class, $cible);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cible_index', [
                'id' => $cible->getId(),
            ]);
        }

        return $this->render('cible/edit.html.twig', [
            'cible' => $cible,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cible_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cible $cible): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cible->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cible);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cible_index');
    }
}
