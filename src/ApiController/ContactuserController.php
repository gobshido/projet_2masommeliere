<?php

namespace App\ApiController;

use App\Repository\ContactuserRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contactuser;
use App\Form\ContactuserType;

/**
 * @Route("/contactuser", host="api.masommeliere.fr")
 */
class ContactuserController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Contactuser resource
     * @Rest\Route(
     *     "/",
     *     name="contactuser_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(ContactuserRepository $contactuserRepository):View
    {
        $contactusers = $contactuserRepository->findAll();
        return View::create($contactusers, Response::HTTP_OK);
    }

    /**
     * Retrieves a Contactuser resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="contactusershow_api")
     * @Rest\View()
     * @param Contactuser $contactuser
     * @return View
     */
    public function show(Contactuser $contactuser):View
    {
        return View::create($contactuser, Response::HTTP_OK);
    }

    /**
     * Creates a Contactuser resource
     * @Rest\Post(
     *     path="/new",
     *     name="contactusernew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $contactuser = new Contactuser();
        $contactuser->setTelephone($request->get('telephone'));
        $contactuser->setJourOuverture($request->get('jourOuverture'));
        $contactuser->setHeureOuverture($request->get('heureOuverture'));
        $contactuser->setHeureFermeture($request->get('heureFermeture'));
        $contactuser->setPresentation($request->get('presentation'));
        $contactuser->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($contactuser);
        $em->flush();
        return View::create($contactuser, Response::HTTP_CREATED);
    }

    /**
     * Remove a Contactuser resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="contactuserdelete_api")
     * @param Contactuser $contactuser
     * @Rest\View()
     * @return View
     */
    public function delete(Contactuser $contactuser):View
    {
        if ($contactuser){
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactuser);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Contactuser resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="contactuseredit_api")
     * @param Request $request
     * @param Contactuser $contactuser
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Contactuser $contactuser):View
    {
        if($contactuser){
            $contactuser->setTelephone($request->get('telephone'));
            $contactuser->setJourOuverture($request->get('jourOuverture'));
            $contactuser->setHeureOuverture($request->get('heureOuverture'));
            $contactuser->setHeureFermeture($request->get('heureFermeture'));
            $contactuser->setPresentation($request->get('presentation'));
            $contactuser->setImage($request->get('image'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactuser);
            $em->flush();
        }
        return View::create($contactuser, Response::HTTP_OK);
    }

    /**
     * Creates a Contactuser resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="contactuserpatch_api")
     * @param Request $request
     * @param Contactuser $contactuser
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Contactuser $contactuser):View
    {
        if($contactuser){
            $form = $this->createForm(ContactuserType::class, $contactuser);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactuser);
            $em->flush();
        }
        return View::create($contactuser, Response::HTTP_OK);
    }
}