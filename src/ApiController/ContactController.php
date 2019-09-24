<?php

namespace App\ApiController;

use App\Repository\CategorieRepository;
use App\Repository\CibleRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;

/**
* @Route("/contact", host="api.masommeliere.fr")
*/
class ContactController extends AbstractFOSRestController
{
    /**
     * Creates a Contact resource
     * @Rest\Post(
     *     path="/new",
     *     name="contactnew_api")
     */
    public function new(Request $request, CategorieRepository $categorieRepository, CibleRepository $cibleRepository):View
    {
        $categoryrequest= $categorieRepository->find($request->get('category'));
        $ciblerequest= $cibleRepository->find($request->get('cible'));
        $contact = new Contact();
        $contact->setEmail($request->get('email'));
        $contact->setLastname($request->get('lastname'));
        $contact->setFirstname($request->get('firstname'));
        $contact->setMessage($request->get('message'));
        $contact->setSent($request->get('sent'));
        $contact->setCategory($categoryrequest);
        $contact->setCible($ciblerequest);

        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return View::create($contact, Response::HTTP_CREATED);
    }
}
