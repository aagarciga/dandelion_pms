<?php


namespace App\Entity;

use Doctrine\ORM\Mapping\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
/** @MappedSuperclass */
abstract class Service
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=16, scale=8)
     */
    private $price;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}