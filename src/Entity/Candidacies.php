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

    #[ORM\OneToMany(mappedBy: 'candidacies', targetEntity: Users::class)]
    private Collection $User_id;

    public function __construct()
    {
        $this->User_id = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Users>
     */
    public function getUserId(): Collection
    {
        return $this->User_id;
    }

    public function addUserId(Users $userId): self
    {
        if (!$this->User_id->contains($userId)) {
            $this->User_id->add($userId);
            $userId->setCandidacies($this);
        }

        return $this;
    }

    public function removeUserId(Users $userId): self
    {
        if ($this->User_id->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getCandidacies() === $this) {
                $userId->setCandidacies(null);
            }
        }

        return $this;
    }
}
