<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $faker->seed(0);

        for ($i=0; $i < 50; $i++) { 
        
            $booking = new Booking();
            $startDate = $faker->dateTimeBetween('-3 months');
            $days = rand(2,10);
            $endDate = (clone $startDate)->modify("+$days days");

            $booking
                ->setUser($this->getReference(($i % 2) ? 'user_user' : 'user_admin'))
                ->setRoom($this->getReference('rooms_room'.rand(0,9)))
                ->setCreateAt(new DateTime())
                ->setStartDate($startDate)
                ->setEndDate($endDate)
            ;
            
            $manager->persist($booking);

            $manager->flush();
        }
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            RoomFixtures::class
        );
    }
}
