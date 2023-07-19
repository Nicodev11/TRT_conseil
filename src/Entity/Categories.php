<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category_id', targetEntity: Annoncement::class)]
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

    /**
     * @return Collection<int, Annoncement>
     */
    public function getAnnoncements(): Collection
    {
        return $this->annoncements;
    }

    public function addAnnoncement(Annoncement $annoncement): self
    {
        if (!$this->annoncements->contains($annoncement)) {
            $this->annoncements->add($annoncement);
            $annoncement->setCategoryId($this);
        }

        return $this;
    }

    public function removeAnnoncement(Annoncement $annoncement): self
    {
        if ($this->annoncements->removeElement($annoncement)) {
            // set the owning side to null (unless already changed)
            if ($annoncement->getCategoryId() === $this) {
                $annoncement->setCategoryId(null);
            }
        }

        return $this;
    }
}
