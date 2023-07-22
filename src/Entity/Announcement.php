<?php

namespace App\Entity;

use App\Repository\AnnouncementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnouncementRepository::class)]
class Announcement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'announcements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $category_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'announcements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Company $company_id = null;

    #[ORM\Column]
    private ?int $hours = null;

    #[ORM\Column]
    private ?float $salary = null;

    #[ORM\Column]
    #[ORM\JoinColumn(nullable: true)]
    private ?bool $is_valided = false;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'announcement_id', targetEntity: Candidacies::class)]
    private Collection $candidacies;

    #[ORM\ManyToOne(inversedBy: 'announcements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contract $contract_id = null;

    #[ORM\ManyToOne(inversedBy: 'announcements')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Users $user_id = null;

    public function __toString(): string
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->candidacies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategoryId(): ?Categories
    {
        return $this->category_id;
    }

    public function setCategoryId(?Categories $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->company_id;
    }

    public function setCompanyId(?Company $company_id): self
    {
        $this->company_id = $company_id;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function isIsValided(): ?bool
    {
        return $this->is_valided;
    }

    public function setIsValided(?bool $is_valided): self
    {
        $this->is_valided = $is_valided;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Candidacies>
     */
    public function getCandidacies(): Collection
    {
        return $this->candidacies;
    }

    public function addCandidacy(Candidacies $candidacy): self
    {
        if (!$this->candidacies->contains($candidacy)) {
            $this->candidacies->add($candidacy);
            $candidacy->setAnnouncementId($this);
        }

        return $this;
    }

    public function removeCandidacy(Candidacies $candidacy): self
    {
        if ($this->candidacies->removeElement($candidacy)) {
            // set the owning side to null (unless already changed)
            if ($candidacy->getAnnouncementId() === $this) {
                $candidacy->setAnnouncementId(null);
            }
        }

        return $this;
    }

    public function getContractId(): ?Contract
    {
        return $this->contract_id;
    }

    public function setContractId(?Contract $contract_id): self
    {
        $this->contract_id = $contract_id;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
