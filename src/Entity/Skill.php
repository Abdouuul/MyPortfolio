<?php

namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass=App\Repository\SkillRepository::class)
 * @ORM\Table(name="app_skills")
 */
class Skill
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
     * @ORM\Column(type="string", length=255)
     */
    private $iconLink;

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
     * Get the value of iconLink
     */
    public function getIconLink(): ?string
    {
        return $this->iconLink;
    }

    /**
     * Set the value of iconLink
     *
     * @return  self
     */
    public function setIconLink(?string $iconLink)
    {
        $this->iconLink = $iconLink;

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
