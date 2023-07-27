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

#[Route('/consultant', name: 'consultant_announcement_')]
class AnnouncementController extends AbstractController
{
    #[Route("/", name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('consultant/announcement/pending_offers.html.twig');
    }

    #[Route("/liste-dattente", name: 'pending_offers', methods: ['GET'])]
    public function pendingOffers(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('consultant/announcement/pending_offers.html.twig', [
            'announcements' => $announcementRepository->findBy(
                ['is_valided' => false],
                ['created_at' => 'ASC']
            ),
        ]);
    }

    #[Route("/offres-validees", name: 'validated_offers', methods: ['GET'])]
    public function validatedOffers(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render('consultant/announcement/validated_offers.html.twig', [
            'announcements' => $announcementRepository->findBy(
                ['is_valided' => true],
                ['created_at' => 'DESC']
            ),
        ]);
    }

    #[Route('/{name}{id}', name: 'show', methods: ['GET'])]
    public function show(Announcement $announcement): Response
    {

        $contractName = $announcement->getContractId()->getName();

        return $this->render('consultant/announcement/show.html.twig', [
            'announcement' => $announcement,
            'contractName' => $contractName,
        ]);
    }

    #[Route('validate/{id}', name: 'validate', methods: ['POST'])]
    public function validate(Request $request, Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('validate'.$announcement->getId(), $request->request->get('_token'))) {
            $announcement->setIsValided(true);
            $entityManager->persist($announcement);
            $entityManager->flush();

            $this->addFlash('success', 'L\'annonce a bien été validée');
        } 

        $this->addFlash('danger', 'Une erreur est survenue lors de la validation de l\'annonce');

        return $this->redirectToRoute('consultant_announcement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Announcement $announcement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$announcement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($announcement);
            $entityManager->flush();

            $this->addFlash('success', 'L\'annonce a bien été supprimée');
        }

        $this->addFlash('danger', 'Une erreur est survenue lors de la suppression de l\'annonce');
        
        return $this->redirectToRoute('consultant_announcement_index', [], Response::HTTP_SEE_OTHER);
    }

}
