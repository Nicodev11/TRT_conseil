<?php

namespace App\Controller\admin\recruiter;

use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recruteur', name: 'recruiter_announcement_')]
class AnnouncementController extends AbstractController
{

    #[Route('/mes-annonces', name: 'index', methods: ['GET'])]
    public function index(AnnouncementRepository $announcementRepository): Response
    {
        $company = $this->getUser()->getCompany();

        return $this->render('recruiter/announcement/index.html.twig', [
            'announcements' => $announcementRepository->findAll(),
            'company' => $company,
        ]);
    }

    #[Route('/ajout', name: 'add', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $company = $user->getCompany();

        $announcement = new Announcement(); 
        $announcement->setUser($user);
        $announcement->setCompany($company);
        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($announcement);
            $entityManager->flush();

            return $this->redirectToRoute('recruiter_announcement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recruiter/announcement/new.html.twig', [
            'announcement' => $announcement,
            'form' => $form,
        ]);
    }

    #[Route('/{name}/{id}', name: 'show', methods: ['GET'])]
    public function show(Announcement $announcement): Response
    {

        $contractName = $announcement->getContractId()->getName();
        $company = $announcement->getCompany();

        return $this->render('recruiter/announcement/show.html.twig', [
            'announcement' => $announcement,
            'company' => $company,
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

            return $this->redirectToRoute('recruiter_announcement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recruiter/announcement/edit.html.twig', [
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

        return $this->redirectToRoute('recruiter_announcement_index', [], Response::HTTP_SEE_OTHER);
    }
}
