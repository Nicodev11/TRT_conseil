<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adress = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'company_id')]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'company_id', targetEntity: Annoncement::class)]
    private Collection $annoncements;

    public function __construct()
    {
        $this->annoncements = new ArrayCollection();
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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Annoncement>
     */
    public function getAnnoncements(): Collection
    {
        return $this->annoncements;
    }

    public function addAnnoncement(Announcement $annoncement): self
    {
        if (!$this->annoncements->contains($annoncement)) {
            $this->annoncements->add($annoncement);
            $annoncement->setCompanyId($this);
        }

        return $this;
    }

    public function removeAnnoncement(Announcement $annoncement): self
    {
        if ($this->annoncements->removeElement($annoncement)) {
            // set the owning side to null (unless already changed)
            if ($annoncement->getCompanyId() === $this) {
                $annoncement->setCompanyId(null);
            }
        }

        return $this;
    }
}
