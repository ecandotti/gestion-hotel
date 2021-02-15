<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 10; $i++) {
            $room = new Room();
            $room
                ->setName('Room '.($i + 1))
                ->setNumber($i+1)
                ->setPrice(rand(50,100))
            ;
            $manager->persist($room);
            $this->addReference('rooms_room'.$i, $room);
        }

        $manager->flush();
    }
}
