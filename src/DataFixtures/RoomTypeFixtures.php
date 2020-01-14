<?php

namespace App\DataFixtures;

use App\Entity\RoomType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoomTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $single = new RoomType();
        $single->setName('Standard Single Room');
        $manager->persist($single);

        $double = new RoomType();
        $double->setName('Standard Double Room');
        $manager->persist($double);

        $triple = new RoomType();
        $triple->setName('Standard Triple Room');
        $manager->persist($triple);

        $manager->flush();
    }
}
