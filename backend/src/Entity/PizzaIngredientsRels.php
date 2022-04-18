<?php

namespace App\Entity;

use App\Repository\PizzaIngredientsRelsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaIngredientsRelsRepository::class)]
class PizzaIngredientsRels
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: pizza::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $pizza;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ingredients::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $ingredients;

    public function getPizzaId(): ?pizza
    {
        return $this->pizza;
    }

    public function setPizzaId(?pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getPizza(): ?pizza
    {
        return $this->pizza;
    }

    public function setPizza(?pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function getIngredients(): ?ingredients
    {
        return $this->ingredients;
    }

    public function setIngredients(?ingredients $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }
}
