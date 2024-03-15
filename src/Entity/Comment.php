<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_comment = null;

    #[ORM\Column(length: 255)]
    private ?string $content_comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->date_comment;
    }

    public function setDateComment(\DateTimeInterface $date_comment): static
    {
        $this->date_comment = $date_comment;

        return $this;
    }

    public function getContentComment(): ?string
    {
        return $this->content_comment;
    }

    public function setContentComment(string $content_comment): static
    {
        $this->content_comment = $content_comment;

        return $this;
    }
}
