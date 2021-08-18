<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coursTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coursDetails;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creatAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Available;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="cours", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=Chapitre::class, mappedBy="cours", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $chapitres;

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoursTitle(): ?string
    {
        return $this->coursTitle;
    }

    public function setCoursTitle(string $coursTitle): self
    {
        $this->coursTitle = $coursTitle;

        return $this;
    }

    public function getCcoursDetails(): ?string
    {
        return $this->coursDetails;
    }

    public function setCoursDetails(string $coursDetails): self
    {
        $this->coursDetails = $coursDetails;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
    */
    public function setCreatAt()
    {
        $this->creatAt = new \DateTime();
    }

    public function getAvailable(): ?bool
    {
        return $this->Available;
    }

    public function setAvailable(bool $Available): self
    {
        $this->Available = $Available;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|Chapitre[]
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres[] = $chapitre;
            $chapitre->setCours($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->removeElement($chapitre)) {
            // set the owning side to null (unless already changed)
            if ($chapitre->getCours() === $this) {
                $chapitre->setCours(null);
            }
        }

        return $this;
    }
}
