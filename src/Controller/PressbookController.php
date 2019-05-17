<?php

namespace App\Controller;

use App\Entity\Pressbook;
use App\Form\PressbookType;
use App\Repository\PressbookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pressbook")
 */
class PressbookController extends AbstractController
{
    /**
     * @Route("/", name="pressbook_index", methods={"GET"})
     */
    public function index(PressbookRepository $pressbookRepository): Response
    {
        return $this->render('pressbook/index.html.twig', [
            'pressbooks' => $pressbookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pressbook_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pressbook = new Pressbook();
        $form = $this->createForm(PressbookType::class, $pressbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $image = $pressbook->getImage();
            $file = $form->get('image')->get('file')->getData();
            if($file)
            {
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName
                    );
                }catch (FileException $e){
                    echo 'image not found';
                }
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImgpath($this->getParameter('image_path').'/'.$fileName);
                $pressbook->setImage($image);
            }else{
                $pressbook->setImage(null);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pressbook);
            $entityManager->flush();

            return $this->redirectToRoute('pressbook_index');
        }

        return $this->render('pressbook/new.html.twig', [
            'pressbook' => $pressbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pressbook_show", methods={"GET"})
     */
    public function show(Pressbook $pressbook): Response
    {
        return $this->render('pressbook/show.html.twig', [
            'pressbook' => $pressbook,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pressbook_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pressbook $pressbook): Response
    {
        $form = $this->createForm(PressbookType::class, $pressbook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $pressbook->getImage();
            $file = $form->get('image')->get('file')->getData();
            if($file)
            {
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('image_abs_path'),
                        $fileName
                    );
                }catch (FileException $e){
                    echo 'image not found';
                }
                $this->removeFile($image->getPath());
                $image->setPath($this->getParameter('image_abs_path').'/'.$fileName);
                $image->setImgpath($this->getParameter('image_path').'/'.$fileName);
                $pressbook->setImage($image);
            }
            if ( $image && empty($image->getId()) && !$file){
                $pressbook->setImage(null);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pressbook_index', [
                'id' => $pressbook->getId(),
            ]);
        }

        return $this->render('pressbook/edit.html.twig', [
            'pressbook' => $pressbook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pressbook_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pressbook $pressbook): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pressbook->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $image = $pressbook->getImage();
            if($image){
                $this->removeFile($image->getPath());
            }
            $entityManager->remove($pressbook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pressbook_index');
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    private function removeFile($path)
    {
        if(file_exists($path)){
            unlink($path);
        }
    }
}