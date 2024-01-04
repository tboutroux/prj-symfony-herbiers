<?php

namespace App\Controller;

use App\Entity\Releves;
use App\Form\RelevesType;
use App\Repository\RelevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/releves')]
class RelevesController extends AbstractController
{
    #[Route('/', name: 'app_releves_index', methods: ['GET'])]
    public function index(RelevesRepository $relevesRepository): Response
    {
        return $this->render('releves/index.html.twig', [
            'releves' => $relevesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_releves_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $relefe = new Releves();
        $form = $this->createForm(RelevesType::class, $relefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($relefe);
            $entityManager->flush();

            return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('releves/new.html.twig', [
            'relefe' => $relefe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_releves_show', methods: ['GET'])]
    public function show(Releves $relefe): Response
    {
        return $this->render('releves/show.html.twig', [
            'relefe' => $relefe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_releves_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Releves $relefe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelevesType::class, $relefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('releves/edit.html.twig', [
            'relefe' => $relefe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_releves_delete', methods: ['POST'])]
    public function delete(Request $request, Releves $relefe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relefe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($relefe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
    }
}
