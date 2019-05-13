<?php

namespace App\Controller;

use App\Entity\Pdf;
use App\Form\PdfType;
use App\Repository\PdfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pdf")
 */
class PdfController extends AbstractController
{
    /**
     * @Route("/", name="pdf_index", methods={"GET"})
     */
    public function index(PdfRepository $pdfRepository): Response
    {
        return $this->render('pdf/index.html.twig', [
            'pdfs' => $pdfRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pdf_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pdf = new Pdf();
        $form = $this->createForm(PdfType::class, $pdf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pdf);
            $entityManager->flush();

            return $this->redirectToRoute('pdf_index');
        }

        return $this->render('pdf/new.html.twig', [
            'pdf' => $pdf,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pdf_show", methods={"GET"})
     */
    public function show(Pdf $pdf): Response
    {
        return $this->render('pdf/show.html.twig', [
            'pdf' => $pdf,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pdf_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pdf $pdf): Response
    {
        $form = $this->createForm(PdfType::class, $pdf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pdf_index', [
                'id' => $pdf->getId(),
            ]);
        }

        return $this->render('pdf/edit.html.twig', [
            'pdf' => $pdf,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pdf_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pdf $pdf): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pdf->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pdf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pdf_index');
    }
}
