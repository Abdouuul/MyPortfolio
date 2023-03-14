<?php

namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ResumeFilesRepository::class)
 * @ORM\Table(name="app_files")
 */
class ResumeFiles
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
     * Get the value of path
     */ 
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath(?string $path)
    {
        $this->path = $path;

        return $this;
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
}
