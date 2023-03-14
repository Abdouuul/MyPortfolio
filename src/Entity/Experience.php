<?php

namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=App\Repository\ExperienceRepository::class)
 * @ORM\Table(name="app_experiences")
 */
class Experience
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
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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
        return ucfirst($this->name);
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(?string $name)
    {
        $this->name = ucfirst($name);

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

    /**
     * Get the value of startDate
     */ 
    public function getStartDate(): \DateTimeInterface
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
    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * Set the value of endDate
     *
     * @return  self
     */ 
    public function setEndDate(\DateTimeInterface $endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }
}