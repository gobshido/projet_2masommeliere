<?php

namespace App\Controller;

use App\Entity\PriceType;
use App\Form\PriceTypeType;
use App\Repository\PriceTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/price/type")
 */
class PriceTypeController extends AbstractController
{
    /**
     * @Route("/", name="price_type_index", methods={"GET"})
     */
    public function index(PriceTypeRepository $priceTypeRepository): Response
    {
        return $this->render('price_type/index.html.twig', [
            'price_types' => $priceTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="price_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $priceType = new PriceType();
        $form = $this->createForm(PriceTypeType::class, $priceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($priceType);
            $entityManager->flush();

            return $this->redirectToRoute('price_type_index');
        }

        return $this->render('price_type/new.html.twig', [
            'price_type' => $priceType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_type_show", methods={"GET"})
     */
    public function show(PriceType $priceType): Response
    {
        return $this->render('price_type/show.html.twig', [
            'price_type' => $priceType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="price_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PriceType $priceType): Response
    {
        $form = $this->createForm(PriceTypeType::class, $priceType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('price_type_index', [
                'id' => $priceType->getId(),
            ]);
        }

        return $this->render('price_type/edit.html.twig', [
            'price_type' => $priceType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="price_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PriceType $priceType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$priceType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($priceType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('price_type_index');
    }
}
