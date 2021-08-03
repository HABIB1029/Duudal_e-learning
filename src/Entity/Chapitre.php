<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ChapitreRepository::class)
 */
class Chapitre
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAvailable;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="chapitres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $documentExtension;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $videoExtension;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="chapitre", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $comment;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setCreatAt()
    {
        $this->creatAt = new \DateTime();
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getDocumentExtension(): ?string
    {
        return $this->documentExtension;
    }

    public function setDocumentExtension(string $documentExtension): self
    {
        $this->documentExtension = $documentExtension;

        return $this;
    }

    public function getVideoExtension(): ?string
    {
        return $this->videoExtension;
    }

    public function setVideoExtension(string $videoExtension): self
    {
        $this->videoExtension = $videoExtension;

        return $this;
    }

    /**
    *@ORM\PrePersist
    *@ORM\PreUpdate
    */
    public function initSlug()
    {
        
            $slugger = new Slugify();
            return $this->slug = $slugger->slugify($this->title);
        
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setChapitre($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getChapitre() === $this) {
                $comment->setChapitre(null);
            }
        }

        return $this;
    }
}
