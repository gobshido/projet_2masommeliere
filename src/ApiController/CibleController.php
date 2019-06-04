<?php

namespace App\ApiController;

use App\Repository\CibleRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cible;
use App\Form\CibleType;

/**
 * @Route("/cible", host="api.masommeliere.fr")
 */
class CibleController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Cible resource
     * @Rest\Route(
     *     "/",
     *     name="cible_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(CibleRepository $cibleRepository):View
    {
        $cibles = $cibleRepository->findAll();
        return View::create($cibles, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Cible resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="cibleshow_api")
     * @Rest\View()
     * @param Cible $categorie
     * @return View
     */
    public function show(Cible $cible):View
    {
        return View::create($cible, Response::HTTP_OK);
    }

    /**
     * Creates a Cible resource
     * @Rest\Post(
     *     path="/new",
     *     name="ciblenew_api")
     * @Rest\View()
     * @param Request $request
     * @return View
     */
    public function new(Request $request):View
    {
        $cible = new Cible();
        $cible->setNom($request->get('nom'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($cible);
        $em->flush();
        return View::create($cible, Response::HTTP_CREATED);
    }

    /**
     * Remove a Cible resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="cibledelete_api")
     * @Rest\View()
     * @param Cible $cible
     * @return View
     */
    public function delete(Cible $cible):View
    {
        if($cible){
            $em = $this->getDoctrine()->getManager();
            $em->remove($cible);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Cible resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="cibleedit_api")
     * @Rest\View()
     * @param Request $request
     * @param Cible $cible
     * @return View
     */
    public function edit(Request $request, Cible $cible):View
    {
        if ($cible){
            $cible->setNom($request->get('nom'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($cible);
            $em->flush();
        }
        return View::create($cible, Response::HTTP_OK);
    }

    /**
     * Creates a Cible resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="ciblepatch_api")
     * @Rest\View()
     * @param Request $request
     * @param Cible $cible
     * @return View
     */
    public function patch(Request $request, Cible $cible):View
    {
        if ($cible){
            $form = $this->createForm(CibleType::class, $cible);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cible);
            $em->flush();
        }
        return View::create($cible, Response::HTTP_OK);
    }
}
