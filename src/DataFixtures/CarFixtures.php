<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [ DriverFixtures::class,];
    }
    public function load(ObjectManager $manager): void
    {
        $car = new Car();
        $car->setModel('Tesla');
        $car->setMake('X');
        $car->setColor('teal');
        $car->setYear(2024);
        $car->setTransmission('Automatic');
        $car->setDriverid($this->getReference('driver'));

        $manager->persist($car);

        $car2 = new Car();
        $car2->setModel('Tesla');
        $car2->setMake('Y');
        $car2->setColor('white');
        $car2->setYear(2018);
        $car2->setTransmission('Automatic');
        $manager->persist($car2);

        $car3 = new Car();
        $car3->setModel('Tesla');
        $car3->setMake('S');
        $car3->setColor('black');
        $car3->setYear(2015);
        $car3->setTransmission('Automatic');
        $manager->persist($car3);



        $manager->flush();
    }
}
