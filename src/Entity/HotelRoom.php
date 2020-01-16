<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRoomRepository")
 */
class HotelRoom extends Service
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $keyCount;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HotelRoomCategory", inversedBy="hotelRooms")
     */
    private $category;

    public function getKeyCount(): ?int
    {
        return $this->keyCount;
    }

    public function setKeyCount(int $keyCount): self
    {
        $this->keyCount = $keyCount;

        return $this;
    }

    public function getCategory(): ?HotelRoomCategory
    {
        return $this->category;
    }

    public function setCategory(?HotelRoomCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

}
