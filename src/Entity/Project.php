<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ProjectRepository::class)
 * @ORM\Table(name="app_project")
 */
class Project 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="please enter the name of the project")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="please enter the description of the project")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gitLink;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable="true")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Update::class, mappedBy="project", orphanRemoval=true)
     */
    private $updates;

    /**
     * @ORM\OneToMany(targetEntity=ProjectImages::class, mappedBy="project", orphanRemoval=true, cascade={"persist"})
     */
    private $images;

    private $uploadedFiles;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->images = new ArrayCollection();
    }
      

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(?string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of gitLink
     */ 
    public function getGitLink(): ?string
    {
        return $this->gitLink;
    }

    /**
     * Set the value of gitLink
     *
     * @return  self
     */ 
    public function setGitLink(?string $gitLink)
    {
        $this->gitLink = $gitLink;

        return $this;
    }

    /**
     * Get the value of startDate
     */ 
    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * Set the value of startDate
     *
     * @return  self
     */ 
    public function setStartDate(\DateTimeInterface $startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get the value of endDate
     */ 
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate(?\DateTimeInterface $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updates
     * @return Collection|Update[]
     */ 
    public function getUpdates(): Collection
    {
        return $this->updates;
    }

    /**
     * add an update to Project
     *
     */ 
    public function addUpdate(Update $update)
    {
        if(!$this->updates->contains($update)){
            $this->updates[] = $update;
            $update->setProject($this);
        }
    }   

    /**
     * Get the value of images
     * @return Collection|ProjectImages[]
     */ 
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function addImages(ProjectImages $image): self
    {
        if(!$this->images->contains($image)){
            $this->images[] = $image;
            $image->setProject($this);
        }

        return $this;
    }

    /**
     * Get the value of uploadedFiles
     */ 
    public function getUploadedFiles(): ?array
    {
        return $this->uploadedFiles;
    }
    
    /**
     * Set the value of uploadedFiles
     *
     * @return  self
     */ 
    public function setUploadedFiles(?array $uploadedFiles)
    {
        $this->uploadedFiles = $uploadedFiles;

        return $this;
    }   
    
    public function __toString()
    {
        return $this->name;
    }
}