<?php

namespace App\Controller;

use App\Entity\Targetprice;
use App\Form\TargetpriceType;
use App\Repository\TargetpriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/targetprice")
 */
class TargetpriceController extends AbstractController
{
    /**
     * @Route("/", name="targetprice_index", methods={"GET"})
     */
    public function index(TargetpriceRepository $targetpriceRepository): Response
    {
        return $this->render('targetprice/index.html.twig', [
            'targetprices' => $targetpriceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="targetprice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $targetprice = new Targetprice();
        $form = $this->createForm(TargetpriceType::class, $targetprice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($targetprice);
            $entityManager->flush();

            return $this->redirectToRoute('targetprice_index');
        }

        return $this->render('targetprice/new.html.twig', [
            'targetprice' => $targetprice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="targetprice_show", methods={"GET"})
     */
    public function show(Targetprice $targetprice): Response
    {
        return $this->render('targetprice/show.html.twig', [
            'targetprice' => $targetprice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="targetprice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Targetprice $targetprice): Response
    {
        $form = $this->createForm(TargetpriceType::class, $targetprice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('targetprice_index', [
                'id' => $targetprice->getId(),
            ]);
        }

        return $this->render('targetprice/edit.html.twig', [
            'targetprice' => $targetprice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="targetprice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Targetprice $targetprice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$targetprice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($targetprice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('targetprice_index');
    }
}
