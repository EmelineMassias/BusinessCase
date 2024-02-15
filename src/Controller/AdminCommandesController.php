<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Form\CommandesType;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;


#[Route('/admin/commandes')]
class AdminCommandesController extends AbstractController
{
    #[Route('/', name: 'app_admin_commandes_index', methods: ['GET'])]
    public function index(CommandesRepository $commandesRepository): Response
    {
        return $this->render('admin_commandes/index.html.twig', [
            'commandes' => $commandesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_commandes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $commande = new Commandes();
        $form = $this->createForm(CommandesType::class, $commande);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($commande);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_commandes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_commandes/new.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_commandes_show', methods: ['GET'])]
    public function show(Commandes $commande): Response
    {
        return $this->render('admin_commandes/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_commandes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commandes $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandesType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_commandes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_commandes/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_commandes_delete', methods: ['POST'])]
    public function delete(Request $request, Commandes $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_commandes_index', [], Response::HTTP_SEE_OTHER);
    }
}
