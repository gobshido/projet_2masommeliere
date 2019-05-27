<?php

namespace App\ApiController;

use App\Repository\PdfRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pdf;
use App\Form\PdfType;

/**
 * @Route("/pdf", host="api.masommeliere.fr")
 */
class PdfController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Pdf resource
     * @Rest\Route(
     *     "/",
     *     name="pdf_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(PdfRepository $pdfRepository):View
    {
        $pdfs = $pdfRepository->findAll();
        return View::create($pdfs, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Pdf resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="pdfshow_api")
     * @param Pdf $pdf
     * @Rest\View()
     * @return View
     */
    public function show(Pdf $pdf):View
    {
        return View::create($pdf, Response::HTTP_OK);
    }

    /**
     * Creates a Pdf resource
     * @Rest\Post(
     *     path="/new",
     *     name="pdfnew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $pdf = new Pdf();
        $pdf->setPathrelatif($request->get('pathrelatif'));
        $pdf->setPathabsolu($request->get('pathabsolu'));
        $pdf->setFile($request->get('file'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($pdf);
        $em->flush();
        return View::create($pdf, Response::HTTP_CREATED);
    }

    /**
     * Delete a Pdf resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="pdfdelete_api")
     * @param Pdf $pdf
     * @Rest\View()
     * @return View
     */
    public function delete(Pdf $pdf):View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pdf);
        $em->flush();
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Pdf resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="pdfedit_api")
     * @param Request $request
     * @param Pdf $pdf
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Pdf $pdf):View
    {
        if($pdf){
            $pdf->setPathrelatif($request->get('pathrelatif'));
            $pdf->setPathabsolu($request->get('pathabsolu'));
            $pdf->setFile($request->get('file'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($pdf);
            $em->flush();
        }
        return View::create($pdf, Response::HTTP_OK);
    }

    /**
     * Creates a Pdf resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="pdfpatch_api")
     * @param Request $request
     * @param Pdf $pdf
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Pdf $pdf):View
    {
        if ($pdf){
            $form = $this->createForm(PdfType::class, $pdf);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pdf);
            $em->flush();
        }
        return View::create($pdf, Response::HTTP_OK);
    }
}
