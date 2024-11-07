<?php

namespace App\DataFixtures;

use App\Entity\Driver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DriverFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $driver = new Driver();
        $driver->setName('John Wayne');
        $driver->setDrivemanual(true);
        $driver->setYearsdriving(23);

        $manager->persist($driver);
        $manager->flush();

        // Add data reference for new driver
        $this->addReference('driver', $driver);
    }
}
