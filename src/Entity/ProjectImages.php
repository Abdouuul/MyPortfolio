<?php

namespace App\Entity;

use App\Entity\Project;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ProjectImagesRepository::class)
 * @ORM\Table(name="app_project_images")
 */

class ProjectImages
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
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="images")
     */
    private $project;

    private $uploadedFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Get the value of link
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */
    public function setPath(?string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * Set the value of project
     *
     * @return  self
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    public function __toString(): string
    {
        return $this->path;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): \DateTimeInterface
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
     * Get the value of uploadedFiles
     */ 
    public function getUploadedFile(): ?string
    {
        return $this->uploadedFile;
    }
    
    /**
     * Set the value of uploadedFiles
     *
     * @return  self
     */ 
    public function setUploadedFile(?string $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }  
}
