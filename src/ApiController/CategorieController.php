<?php

namespace App\ApiController;

use App\Repository\CategorieRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorie;
use App\Form\CategorieType;

/**
 * @Route("/categorie", host="api.masommeliere.fr")
 */
class CategorieController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Categorie resource
     * @Rest\Route(
     *     "/",
     *     name="categorie_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(CategorieRepository $categorieRepository):View
    {
        $categories = $categorieRepository->findAll();
        //In case our GET was a success we need to return de 200 HTTP_OK
        //response with the collection of categorie object
        return View::create($categories, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Categorie resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="categorieshow_api")
     * @Rest\View()
     * @param Categorie $categorie
     * @return View
     */
    public function show(Categorie $categorie):View
    {
        return View::create($categorie, Response::HTTP_OK);
    }

    /**
     * Creates a Categorie resource
     * @Rest\Post(
     *     path="/new",
     *     name="categorienew_api")
     * @Rest\View()
     * @param Request $request
     * @return View
     */
    public function new(Request $request):View
    {
        $categorie = new Categorie();
        $categorie->setNom($request->get('nom'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();
        return View::create($categorie, Response::HTTP_CREATED);
    }

    /**
     * Remove a Categorie resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="categoriedelete_api")
     * @Rest\View()
     * @param Categorie $categorie
     * @return View
     */
    public function delete(Categorie $categorie):View
    {
        if($categorie){
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Categorie resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="categorieedit_api")
     * @Rest\View()
     * @param Request $request
     * @param Categorie $categorie
     * @return View
     */
    public function edit(Request $request, Categorie $categorie):View
    {
        if ($categorie){
            $categorie->setNom($request->get('nom'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
        }
        return View::create($categorie, Response::HTTP_OK);
    }

    /**
     * Creates a Categorie resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="categoriepatch_api")
     * @Rest\View()
     * @param Request $request
     * @param Categorie $categorie
     * @return View
     */
    public function patch(Request $request, Categorie $categorie):View
    {
        if ($categorie){
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
        }
        return View::create($categorie, Response::HTTP_OK);
    }
}
