<?php

namespace App\ApiController;

use App\Repository\ActualiteRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Actualite;
use App\Form\ActualiteType;

/**
 * @Route("/actualite", host="api.masommeliere.fr")
 */
class ActualiteController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Actualite resource
     * @Rest\Route(
     *     "/",
     *     name="actualite_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(ActualiteRepository $actualiteRepository):View
    {
        $actualites = $actualiteRepository->findAll();
        //In case our GET was a success we need to return de 200 HTTP_OK
        //response with the collection of actualite object
        return View::create($actualites, Response::HTTP_OK);
    }

    /**
     * Retrieves a Actualite resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="actualiteshow_api")
     * @Rest\View()
     * @param Actualite $actualite
     * @return View
     */
    public function show(Actualite $actualite):View
    {
        return View::create($actualite, Response::HTTP_OK);
    }

    /**
     * Creates a Actualite resource
     * @Rest\Post(
     *     path="/new",
     *     name="actualitenew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $actualite = new Actualite();
        $actualite->setTitre($request->get('titre'));
        $actualite->setDescription($request->get('description'));
        $actualite->setDate($request->get('date'));
        $actualite->setHeure($request->get('heure'));
        $actualite->setLieu($request->get('lieu'));
        $actualite->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($actualite);
        $em->flush();
        return View::create($actualite, Response::HTTP_CREATED);
    }

    /**
     * Remove a Actualite resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="actualitedelete_api")
     * @Rest\View()
     * @param Actualite $actualite
     * @return View
     */
    public function delete(Actualite $actualite): View
    {
        if($actualite){
            $em = $this->getDoctrine()->getManager();
            $em->remove($actualite);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Actualite resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="actualiteedit_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Actualite $actualite):View
    {
        if ($actualite){
            $actualite->setTitre($request->get('titre'));
            $actualite->setDescription($request->get('description'));
            $actualite->setDate($request->get('date'));
            $actualite->setHeure($request->get('heure'));
            $actualite->setLieu($request->get('lieu'));
            $actualite->setImage($request->get('image'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();
        }
        return View::create($actualite, Response::HTTP_OK);
    }

    /**
     * Creates a Actualite resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="actualitepatch_api")
     * @param Request $request
     * @param Actualite $actualite
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Actualite $actualite):View
    {
        if ($actualite){
            $form= $this->createForm(ActualiteType::class, $actualite);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();
        }
        return View::create($actualite, Response::HTTP_OK);
    }
}
