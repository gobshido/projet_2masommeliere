<?php

namespace App\ApiController;

use App\Entity\Pdf;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/pdf", host="api.masommeliere.fr")
 */
class PdfController extends AbstractFOSRestController
{
    /**
     * Creates a Pdf resource
     * @Rest\Post(
     *     path="/new",
     *     name="pdf_create_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function create(Request $request):View
    {
        $pdf = new Pdf();
        $file = $request->files->get('file');

        if ($file) {
            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('pdf_abs_pathabsolu'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $pdf->setPathabsolu($this->getParameter('pdf_abs_pathabsolu') . '/' . $fileName);
            $pdf->setPathrelatif($this->getParameter('pdf_pathrelatif') . '/' . $fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pdf);
            $em->flush();
        }
        return View::create($pdf, Response::HTTP_CREATED);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
