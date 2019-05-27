<?php

namespace App\ApiController;

use App\Repository\PressbookRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pressbook;
use App\Form\PressbookType;

/**
 * @Route("/pressbook", host="api.masommeliere.fr")
 */
class PressbookController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Pressbook resource
     * @Rest\Route(
     *     "/",
     *     name="pressbook_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(PressbookRepository $pressbookRepository):View
    {
        $pressbooks = $pressbookRepository->findAll();
        return View::create($pressbooks, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Pressbook resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="pressbookshow_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function show(Request $request):View
    {
        return View::create($request, Response::HTTP_OK);
    }

    /**
     * Creates a Pressbook resource
     * @Rest\Post(
     *     path="/new",
     *     name="pressbooknew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $pressbook = new Pressbook();
        $pressbook->setUrl($request->get('url'));
        $pressbook->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($pressbook);
        $em->flush();
        return View::create($pressbook, Response::HTTP_CREATED);
    }

    /**
     * Delete a Pressbook resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="pressbookdelete_api")
     * @param Pressbook $pressbook
     * @Rest\View()
     * @return View
     */
    public function delete(Pressbook $pressbook):View
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($pressbook);
        $em->flush();
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Pressbook resource
     * @Rest\Put(
     *     path="{id}",
     *     name="pressbookedit_api")
     * @param Request $request
     * @param Pressbook $pressbook
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Pressbook $pressbook):View
    {
        if ($pressbook){
            $pressbook->setUrl($request->get('url'));
            $pressbook->setImage($request->get('image'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($pressbook);
            $em->flush();
        }
        return View::create($pressbook, Response::HTTP_OK);
    }

    /**
     * Creates a Pressbook resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="pressbookpatch_api")
     * @param Request $request
     * @param Pressbook $pressbook
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Pressbook $pressbook):View
    {
        if ($pressbook){
            $form = $this->createForm(PressbookType::class, $pressbook);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pressbook);
            $em->flush();
        }
        return View::create($pressbook, Response::HTTP_OK);
    }
}
