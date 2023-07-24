<?php

namespace App\Controller\admin\consultant;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consultant', name: 'announcement_consultant_')]
class AnnouncementController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('announcement/index.html.twig', [
            'announcements' => $announcementRepository->findBy(
                ['is_valided' => false],
                ['created_at' => 'DESC']
            ),
        ]);
    }

    #[Route('/{name}{id}', name: 'show', methods: ['GET'])]
    public function show(Announcement $announcement): Response
    {

        $contractName = $announcement->getContractId()->getName();

        return $this->render('announcement/show.html.twig', [
            'announcement' => $announcement,
            'contractName' => $contractName,
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('announcement_consultant_index', [], Response::HTTP_SEE_OTHER); 
        }

        return $this->render('announcement/edit.html.twig', [
            'announcement' => $announcement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announcement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($announcement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('announcement_consultant_index', [], Response::HTTP_SEE_OTHER);
    }
}
