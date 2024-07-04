<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[UniqueEntity('title')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message : 'Vous devez remplir ce champ')]
    #[Assert\Regex('/^\w+/')]
    #[Assert\Length(min : 2, max: 150)]
    private ?string $title;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Regex('/^\w+/')]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    #[Assert\Choice(["A faire", "En cours", "Terminée"])]
    private ?string $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

       return $this;

    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;

    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $valeur): static
    {
        $this->status = $valeur;

        return $this;

    }
}
