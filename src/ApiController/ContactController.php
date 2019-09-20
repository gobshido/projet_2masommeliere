<?php

namespace App\ApiController;

use App\Repository\ContactRepository;
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
     * Retrieves a collection of Contact resource
     * @Rest\Route(
     *     "/",
     *     name="contact_api", methods={ "GET" })
     * @Rest\View()
     */
    public function index(ContactRepository $contactRepository):View
    {
        $contact = $contactRepository->findAll();
        //In case our GET was a success we need to return de 200 HTTP_OK
        //response with the collection of actualite object
        return View::create($contact, Response::HTTP_OK);
    }

    /**
     * Retrieves a Contact resource
     * @Rest\Get(
     *     path="/{id}",
     *     name="contactshow_api")
     * @Rest\View()
     * @param Contact $contact
     * @return View
     */
    public function show(Contact $contact):View
    {
        return View::create($contact, Response::HTTP_OK);
    }

    /**
     * Creates a Contact resource
     * @Rest\Post(
     *     path="/new",
     *     name="contactnew_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function new(Request $request):View
    {
        $contact = new Contact();
        $contact->setEmail($request->get('email'));
        $contact->setLastname($request->get('lastname'));
        $contact->setFirstname($request->get('firstname'));
        $contact->setMessage($request->get('message'));
        $contact->setSent($request->get('sent'));
        $contact->setCategory($request->get('category'));
        $contact->setCible($request->get('cible'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return View::create($contact, Response::HTTP_CREATED);
    }

    /**
     * Remove a Contact resource
     * @Rest\Delete(
     *     path="/{id}",
     *     name="contactdelete_api")
     * @Rest\View()
     * @param Contact $contact
     * @return View
     */
    public function delete(Contact $contact): View
    {
        if($contact){
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Creates a Contact resource
     * @Rest\Put(
     *     path="/{id}",
     *     name="contactedit_api")
     * @param Request $request
     * @Rest\View()
     * @return View
     */
    public function edit(Request $request, Contact $contact):View
    {
        if ($contact){
            $contact->setEmail($request->get('email'));
            $contact->setLastname($request->get('lastname'));
            $contact->setFirstname($request->get('firstname'));
            $contact->setMessage($request->get('message'));
            $contact->setSent($request->get('sent'));
            $contact->setCategory($request->get('category'));
            $contact->setCible($request->get('cible'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        }
        return View::create($contact, Response::HTTP_OK);
    }

    /**
     * Creates a Contact resource
     * @Rest\Patch(
     *     path="/{id}",
     *     name="contactpatch_api")
     * @param Request $request
     * @param Contact $contact
     * @Rest\View()
     * @return View
     */
    public function patch(Request $request, Contact $contact):View
    {
        if ($contact){
            $form= $this->createForm(ContactType::class, $contact);
            $form->submit($request->request->all(), false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        }
        return View::create($contact, Response::HTTP_OK);
    }
}
