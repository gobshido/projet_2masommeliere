<?php

namespace App\Controller;

use App\Entity\Pressbook;
use App\Form\PressbookType;
use App\Repository\PressbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pressbook")
 */
class PressbookController extends AbstractController
{
    /**
     * @Route("/", name="pressbook_index", methods={"GET"})
     */
    public function index(PressbookRepository $pressbookRepository): Response
    {
        return $this->render('pressbook/index.html.twig', [
            'pressbooks' => $pressbookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pressbook_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pressbook = new Pressbook();
        $form = $this->createForm(PressbookType::class, $pressbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pressbook);
            $entityManager->flush();

            return $this->redirectToRoute('pressbook_index');
        }

        return $this->render('pressbook/new.html.twig', [
            'pressbook' => $pressbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pressbook_show", methods={"GET"})
     */
    public function show(Pressbook $pressbook): Response
    {
        return $this->render('pressbook/show.html.twig', [
            'pressbook' => $pressbook,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pressbook_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pressbook $pressbook): Response
    {
        $form = $this->createForm(PressbookType::class, $pressbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pressbook_index', [
                'id' => $pressbook->getId(),
            ]);
        }

        return $this->render('pressbook/edit.html.twig', [
            'pressbook' => $pressbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pressbook_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pressbook $pressbook): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pressbook->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pressbook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pressbook_index');
    }
}
