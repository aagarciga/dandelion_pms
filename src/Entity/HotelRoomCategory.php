<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRoomCategoryRepository")
 */
class HotelRoomCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HotelRoom", mappedBy="category")
     */
    private $hotelRooms;

    public function __construct()
    {
        $this->hotelRooms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|HotelRoom[]
     */
    public function getHotelRooms(): Collection
    {
        return $this->hotelRooms;
    }

    public function addHotelRoom(HotelRoom $hotelRoom): self
    {
        if (!$this->hotelRooms->contains($hotelRoom)) {
            $this->hotelRooms[] = $hotelRoom;
            $hotelRoom->setCategory($this);
        }

        return $this;
    }

    public function removeHotelRoom(HotelRoom $hotelRoom): self
    {
        if ($this->hotelRooms->contains($hotelRoom)) {
            $this->hotelRooms->removeElement($hotelRoom);
            // set the owning side to null (unless already changed)
            if ($hotelRoom->getCategory() === $this) {
                $hotelRoom->setCategory(null);
            }
        }

        return $this;
    }
}
