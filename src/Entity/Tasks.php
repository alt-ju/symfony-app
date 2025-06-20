<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[UniqueEntity('title')]
class Tasks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message : 'Vous devez remplir ce champ')]
    #[Assert\Regex('/^\w+/')]
    #[Assert\Length(min : 1, max: 150)]
    private ?string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Regex('/^\w+/')]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    #[Assert\Choice(["A faire", "En cours", "Terminé"])]
    private ?string $status;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    /**
     * Fetch task's id
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Fetch task's title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set a title to a task
     *
     * @param string $title
     * @return static
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

       return $this;

    }

    /**
     * Fetch task's description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set a decsription to a task
     *
     * @param string|null $description
     * @return static
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;

    }

    /**
     * Fetch task's status
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set a status to a task
     *
     * @param string|null $valeur
     * @return static
     */
    public function setStatus(?string $valeur): static
    {
        $this->status = $valeur;

        return $this;

    }

    /**
     * Fetch user's information associated to the task
     *
     * @return Users|null
     */
    public function getUsers(): ?Users
    {
        return $this->user;
    }

    /**
     * Set the user that created the task
     *
     * @param Users|null $user
     * @return static
     */
    public function setUsers(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }
}
