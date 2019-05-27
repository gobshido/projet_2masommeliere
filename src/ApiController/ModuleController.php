<?php

namespace App\ApiController;

use App\Repository\ModuleRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Module;
use App\Form\ModuleType;

/**
 * @Route("/module", host="api.masommeliere.fr")
 */
class ModuleController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Module resource
     * @Rest\Route(
     *     "/",
     *     name="module_api", methods={ "GET" })
     * @Rest\View
     */
    public function index(ModuleRepository $moduleRepository):View
    {
        $modules = $moduleRepository->findAll();
        return View::create($modules, Response::HTTP_OK);
    }

    /**
     * Retrieves a collection of Module resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="moduleshow_api")
     * @param Module $module
     * @Rest\View()
     * @return View
     */
    public function show(Module $module):View
    {
        return View::create($module, Response::HTTP_OK);
    }

    /**
     * Creates a Module resource
     * @Rest\Post(
     *     path="/new",
     *     name="modulenew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $module = new Module();
        $module->setNom($request->get('nom'));
        $module->setDuree($request->get('duree'));
        $module->setDescription($request->get('description'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($module);
        $em->flush();
        return View::create($module, Response::HTTP_CREATED);
    }

    /**
     * Delete a Module resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="moduledelete_api")
     * @param Module $module
     * @Rest\View()
     * @return View
     */
    public function delete(Module $module):View
    {
        if($module){
            $em = $this->getDoctrine()->getManager();
            $em->remove($module);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Module resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="moduleedit_api")
     * @param Request $request
     * @param Module $module
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Module $module):View
    {
        if ($module){
            $module->setNom($request->get('nom'));
            $module->setDuree($request->get('duree'));
            $module->setDescription($request->get('description'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($module);
            $em->flush();
        }
        return View::create($module, Response::HTTP_OK);
    }

    /**
     * Creates a Module resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="modulepatch_api")
     * @param Request $request
     * @param Module $module
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Module $module):View
    {
        if ($module){
            $form = $this->createForm(ModuleType::class, $module);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($module);
            $em->flush();
        }
        return View::create($module, Response::HTTP_OK);
    }
}