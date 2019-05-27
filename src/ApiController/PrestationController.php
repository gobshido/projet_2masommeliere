<?php

namespace App\ApiController;

use App\Repository\PrestationRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Prestation;
use App\Form\PrestationType;

/**
 * @Route("prestation", host="api.masommeliere.fr")
 */
class PrestationController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Prestation resource
     * @Rest\Route(
     *     "/",
     * name="prestation_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(PrestationRepository $prestationRepository):View
    {
        $prestations = $prestationRepository->findAll();
        return View::create($prestations, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Prestation resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="prestationshow_api")
     * @param Prestation $prestation
     * @Rest\View()
     * @return View
     */
    public function show(Prestation $prestation):View
    {
        return View::create($prestation, Response::HTTP_OK);
    }

    /**
     * Creates a Prestation resource
     * @Rest\Post(
     *     path="/new",
     *     name="prestationnew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $prestation = new Prestation();
        $prestation->setCible($request->get('cible'));
        $prestation->setNom($request->get('nom'));
        $prestation->setDescription($request->get('description'));
        $prestation->setCategorie($request->get('categorie'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($prestation);
        $em->flush();
        return View::create($prestation, Response::HTTP_CREATED);
    }

    /**
     * Remove a Prestation resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="prestationdelete_api")
     * @param Prestation $prestation
     * @Rest\View()
     * @return View
     */
    public function delete(Prestation $prestation):View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($prestation);
        $em->flush();
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Prestation resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="prestationedit_api")
     * @param Request $request
     * @param Prestation $prestation
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Prestation $prestation):View
    {
        if ($prestation){
            $prestation->setCible($request->get('cible'));
            $prestation->setNom($request->get('nom'));
            $prestation->setDescription($request->get('description'));
            $prestation->setCategorie($request->get('categorie'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestation);
            $em->flush();
        }
        return View::create($prestation, Response::HTTP_OK);
    }

    /**
     * Creates a Prestation resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="prestationpatch_api")
     * @param Request $request
     * @param Prestation $prestation
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Prestation $prestation):View
    {
        if ($prestation){
            $form = $this->createForm(PrestationType::class, $prestation);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($prestation);
            $em->flush();
        }
        return View::create($prestation, Response::HTTP_OK);
    }
}