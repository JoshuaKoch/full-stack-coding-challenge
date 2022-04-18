<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: orderItems::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $order_item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderItem(): ?orderItems
    {
        return $this->order_item;
    }

    public function setOrderItem(?orderItems $order_item): self
    {
        $this->order_item = $order_item;

        return $this;
    }
}
