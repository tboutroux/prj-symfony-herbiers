<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Releves;
use App\Form\RelevesType;
use App\Repository\RelevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $releves = $entityManager->getRepository(Releves::class)->findAll();

        $relefe = new Releves();
        $form = $this->createForm(RelevesType::class, $relefe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($relefe);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'releves' => $releves,
        ]);
    }
}
