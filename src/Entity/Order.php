<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateOfPurchase = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfPurchase(): ?\DateTimeInterface
    {
        return $this->dateOfPurchase;
    }

    public function setDateOfPurchase(\DateTimeInterface $dateOfPurchase): static
    {
        $this->dateOfPurchase = $dateOfPurchase;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): static
    {
        $this->createDate = $createDate;

        return $this;
    }
}
