<?php

namespace App\ApiController;

use App\Repository\ImageRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Image;
use App\Form\ImageType;

/**
 * @Route("/image", host="api.masommeliere.fr")
 */
class ImageController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Image resource
     * @Rest\Route(
     *     "/",
     *     name="/image_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(ImageRepository $imageRepository):View
    {
        $images = $imageRepository->findAll();
        return View::create($images, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Image resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="imageshow_api")
     * @Rest\View()
     * @param Image $image
     * @return View
     */
    public function show(Image $image):View
    {
        return View::create($image, Response::HTTP_OK);
    }

    /**
     * Creates a Image resource
     * @Rest\Post(
     *     path="/{id}",
     *     name="imagenew_api")
     * @Rest\View()
     * @param Request $request
     * @return View
     */
    public function new(Request $request):View
    {
        $image = new Image();
        $image->setPath($request->get('path'));
        $image->setImgpath($request->get('imgpath'));
        $image->setAlt($request->get('alt'));
        $image->setCredit($request->get('credit'));
        $image->setFile($request->get('file'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($image);
        $em->flush();
        return View::create($image, Response::HTTP_CREATED);
    }

    /**
     * Delete a Image resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="imagedelete_api")
     * @Rest\View()
     * @param Image $image
     * @return View
     */
    public function delete(Image $image):View
    {
        if ($image){
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Image resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="imageedit_api")
     * @Rest\View()
     * @param Request $request
     * @param Image $image
     * @return View
     */
    public function edit(Request $request, Image $image): View
    {
        if ($image){
            $image->setPath($request->get('path'));
            $image->setImgpath($request->get('imgpath'));
            $image->setAlt($request->get('alt'));
            $image->setCredit($request->get('credit'));
            $image->setFile($request->get('file'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
        }
        return View::create($image, Response::HTTP_OK);
    }

    /**
     * Creates a Image resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="imagepatch_api")
     * @param Request $request
     * @param Image $image
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Image $image): View
    {
        if ($image){
            $form = $this->createForm(ImageType::class, $image);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
        }
        return View::create($image, Response::HTTP_OK);
    }
}