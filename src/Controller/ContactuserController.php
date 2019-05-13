<?php

namespace App\Controller;

use App\Entity\Contactuser;
use App\Form\ContactuserType;
use App\Repository\ContactuserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contactuser")
 */
class ContactuserController extends AbstractController
{
    /**
     * @Route("/", name="contactuser_index", methods={"GET"})
     */
    public function index(ContactuserRepository $contactuserRepository): Response
    {
        return $this->render('contactuser/index.html.twig', [
            'contactusers' => $contactuserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contactuser_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contactuser = new Contactuser();
        $form = $this->createForm(ContactuserType::class, $contactuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactuser);
            $entityManager->flush();

            return $this->redirectToRoute('contactuser_index');
        }

        return $this->render('contactuser/new.html.twig', [
            'contactuser' => $contactuser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contactuser_show", methods={"GET"})
     */
    public function show(Contactuser $contactuser): Response
    {
        return $this->render('contactuser/show.html.twig', [
            'contactuser' => $contactuser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contactuser_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contactuser $contactuser): Response
    {
        $form = $this->createForm(ContactuserType::class, $contactuser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contactuser_index', [
                'id' => $contactuser->getId(),
            ]);
        }

        return $this->render('contactuser/edit.html.twig', [
            'contactuser' => $contactuser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contactuser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contactuser $contactuser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactuser->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactuser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contactuser_index');
    }
}
