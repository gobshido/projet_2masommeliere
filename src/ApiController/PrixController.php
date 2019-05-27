<?php

namespace App\ApiController;

use App\Repository\PrixRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Prix;
use App\Form\PrixType;

/**
 * @Route("/prix", host="api.masommeliere.fr")
 */
class PrixController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Prix resource
     * @Rest\Route(
     *     "/",
     *     name="prix_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(PrixRepository $prixRepository):View
    {
        $prices = $prixRepository->findAll();
        return View::create($prices, Response::HTTP_OK);
    }

    /**
     * Retrieves a Prix resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="prixshow_api")
     * @param Prix $prix
     * @Rest\View()
     * @return View
     */
    public function show(Prix $prix):View
    {
        return View::create($prix, Response::HTTP_OK);
    }

    /**
     * Creates a Prix resource
     * @Rest\Post(
     *     path="/new",
     *     name="prixnew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $prix = new Prix();
        $prix->setPrixParticulier($request->get('prixParticulier'));
        $prix->setPrixEntreprise($request->get('prixEntreprise'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($prix);
        $em->flush();
        return View::create($prix, Response::HTTP_CREATED);
    }

    /**
     * Remove a Prix resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="prixdelete_api")
     * @param Prix $prix
     * @Rest\View()
     * @return View
     */
    public function delete(Prix $prix):View
    {
        if($prix){
            $em = $this->getDoctrine()->getManager();
            $em->remove($prix);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Prix resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="prixedit_api")
     * @param Request $request
     * @param Prix $prix
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Prix $prix):View
    {
        if ($prix){
            $prix->setPrixParticulier($request->get('prixParticulier'));
            $prix->setPrixEntreprise($request->get('prixEntreprise'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($prix);
            $em->flush();
        }
        return View::create($prix, Response::HTTP_OK);
    }

    /**
     * Creates a Prix resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="prixpatch_api")
     * @param Request $request
     * @param Prix $prix
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Prix $prix):View
    {
        if ($prix){
            $form = $this->createForm(PrixType::class, $prix);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($prix);
            $em->flush();
        }
        return View::create($prix, Response::HTTP_OK);
    }
}