<?php

namespace App\Controller;

use App\Entity\Vetements;
use App\Form\VetementsType;
use App\Repository\VetementsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/admin/vetements')]
class AdminVetementsController extends AbstractController
{
    #[Route('/', name: 'app_admin_vetements_index', methods: ['GET'])]
    public function index(VetementsRepository $vetementsRepository): Response
    {
        return $this->render('admin_vetements/index.html.twig', [
            'vetements' => $vetementsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_vetements_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $vetement = new Vetements();
        $form = $this->createForm(VetementsType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if($image){
                $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $saveFileName = $slugger->slug($originalFileName);
                $newFileName = $saveFileName. '-' . uniqid() . '-' . $image->guessExtension();

                $image->move(
                    $this->getParameter('vetement_image'),
                    $newFileName
                );
                $vetement->setImage($newFileName);
            }
            $entityManager->persist($vetement);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_vetements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_vetements/new.html.twig', [
            'vetement' => $vetement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_vetements_show', methods: ['GET'])]
    public function show(Vetements $vetement): Response
    {
        return $this->render('admin_vetements/show.html.twig', [
            'vetement' => $vetement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_vetements_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vetements $vetement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VetementsType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_vetements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_vetements/edit.html.twig', [
            'vetement' => $vetement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_vetements_delete', methods: ['POST'])]
    public function delete(Request $request, Vetements $vetement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vetement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vetement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_vetements_index', [], Response::HTTP_SEE_OTHER);
    }
}
