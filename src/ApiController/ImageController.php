<?php

namespace App\ApiController;

use App\Entity\Image;
use App\Repository\ImageRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/image", host="api.masommeliere.fr")
 */
class ImageController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Image resource
     * @Rest\Route(
     *     "/",
     *     name="image_api", methods={ "GET" })
     * @Rest\View
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
     * @param Image $image
     * @Rest\View()
     * @return View
     */
    public function show(Image $image):View
    {
        return View::create($image, Response::HTTP_OK);
    }
}
