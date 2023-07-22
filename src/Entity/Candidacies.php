<?php

namespace App\Entity;

use App\Repository\CandidaciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidaciesRepository::class)]
class Candidacies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'candidacies')]
    private ?Announcement $annoncement_id = null;

    #[ORM\OneToOne(inversedBy: 'candidacies', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $candidacie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnouncementId(): ?Announcement
    {
        return $this->annoncement_id;
    }

    public function setAnnouncementId(?Announcement $annoncement_id): self
    {
        $this->annoncement_id = $annoncement_id;

        return $this;
    }

    public function getCandidacie(): ?Users
    {
        return $this->candidacie;
    }

    public function setCandidacie(Users $candidacie): self
    {
        $this->candidacie = $candidacie;

        return $this;
    }
   
}
