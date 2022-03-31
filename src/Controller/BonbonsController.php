<?php

namespace App\Controller;

use App\Entity\Bonbons;
use App\Form\BonbonsType;
use App\Repository\BonbonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bonbons')]
class BonbonsController extends AbstractController
{
    #[Route('/', name: 'app_bonbons_index', methods: ['GET'])]
    public function index(BonbonsRepository $bonbonsRepository): Response
    {
        return $this->render('bonbons/index.html.twig', [
            'bonbons' => $bonbonsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bonbons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BonbonsRepository $bonbonsRepository): Response
    {
        $bonbon = new Bonbons();
        $form = $this->createForm(BonbonsType::class, $bonbon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bonbonsRepository->add($bonbon);
            return $this->redirectToRoute('app_bonbons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bonbons/new.html.twig', [
            'bonbon' => $bonbon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonbons_show', methods: ['GET'])]
    public function show(Bonbons $bonbon): Response
    {
        return $this->render('bonbons/show.html.twig', [
            'bonbon' => $bonbon,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bonbons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bonbons $bonbon, BonbonsRepository $bonbonsRepository): Response
    {
        $form = $this->createForm(BonbonsType::class, $bonbon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bonbonsRepository->add($bonbon);
            return $this->redirectToRoute('app_bonbons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bonbons/edit.html.twig', [
            'bonbon' => $bonbon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bonbons_delete', methods: ['POST'])]
    public function delete(Request $request, Bonbons $bonbon, BonbonsRepository $bonbonsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bonbon->getId(), $request->request->get('_token'))) {
            $bonbonsRepository->remove($bonbon);
        }

        return $this->redirectToRoute('app_bonbons_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
