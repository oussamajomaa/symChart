<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $publication_place = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $publication_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

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

    public function getPublicationPlace(): ?string
    {
        return $this->publication_place;
    }

    public function setPublicationPlace(?string $publication_place): self
    {
        $this->publication_place = $publication_place;

        return $this;
    }

    public function getPublicationDate(): ?string
    {
        return $this->publication_date;
    }

    public function setPublicationDate(?string $publication_date): self
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
