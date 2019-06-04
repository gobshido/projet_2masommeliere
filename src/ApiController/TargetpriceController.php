<?php

namespace App\ApiController;

use App\Repository\TargetpriceRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Targetprice;
use App\Form\TargetpriceType;

/**
 * @Route("/targetprice", host="api.masommeliere.fr")
 */
class TargetpriceController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Targetprice resource
     * @Rest\Route(
     *     "/",
     *     name="targetprice_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(TargetpriceRepository $targetpriceRepository):View
    {
        $targetprices = $targetpriceRepository->findAll();
        return View::create($targetprices, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Targetprice resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="targetpriceshow_api")
     * @Rest\View()
     * @param Targetprice $targetprice
     * @return View
     */
    public function show(Targetprice $targetprice):View
    {
        return View::create($targetprice, Response::HTTP_OK);
    }

    /**
     * Creates a Targetprice resource
     * @Rest\Post(
     *     path="/new",
     *     name="targetpricenew_api")
     * @Rest\View()
     * @param Request $request
     * @return View
     */
    public function new(Request $request):View
    {
        $targetprice = new Targetprice();
        $targetprice->setNom($request->get('nom'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($targetprice);
        $em->flush();
        return View::create($targetprice, Response::HTTP_CREATED);
    }

    /**
     * Remove a Targetprice resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="targetpricedelete_api")
     * @Rest\View()
     * @param Targetprice $targetprice
     * @return View
     */
    public function delete(Targetprice $targetprice):View
    {
        if($targetprice){
            $em = $this->getDoctrine()->getManager();
            $em->remove($targetprice);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Targetprice resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="targetpriceedit_api")
     * @Rest\View()
     * @param Request $request
     * @param Targetprice $targetprice
     * @return View
     */
    public function edit(Request $request, Targetprice $targetprice):View
    {
        if ($targetprice){
            $targetprice->setNom($request->get('nom'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($targetprice);
            $em->flush();
        }
        return View::create($targetprice, Response::HTTP_OK);
    }

    /**
     * Creates a Targetprice resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="targetpricepatch_api")
     * @Rest\View()
     * @param Request $request
     * @param Targetprice $targetprice
     * @return View
     */
    public function patch(Request $request, Targetprice $targetprice):View
    {
        if ($targetprice){
            $form = $this->createForm(TargetpriceType::class, $targetprice);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($targetprice);
            $em->flush();
        }
        return View::create($targetprice, Response::HTTP_OK);
    }
}
