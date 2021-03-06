<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0;$i<100;$i++){
            $property = new Property;
            $property->setTitle($faker->words(3,true))
                     ->setDescription($faker->sentences(3,true))
                     ->setSurface($faker->numberBetween(20,350))
                     ->setRooms($faker->numberBetween(2,10))
                     ->setBedrooms($faker->numberBetween(1,9))
                     ->setFloor($faker->numberBetween(1,5))
                     ->setHeat($faker->numberBetween(0,1))
                     ->setPrice($faker->numberBetween(10000,1000000))
                     ->setCity($faker->city)
                     ->setAddress($faker->address)
                     ->setPostalCode($faker->postcode)
                     ->setSold(false);
            $manager->persist($property);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
