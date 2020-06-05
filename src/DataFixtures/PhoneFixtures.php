<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class PhoneFixtures.
 */
class PhoneFixtures extends Fixture
{
    /**
     * Load fixtures in Phone table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $phone = new Phone();
        $phone
            ->setBrand('Apple')
            ->setModel('iPhone 11 Pro Max')
            ->setColor('Gold')
            ->setDescription(
                'Capabilities of this iPhone are such that it is the first 
                to earn the Pro designation ! And he deserves it !'
            )
            ->setPrice(1658.99)
        ;
        $manager->persist($phone);

        $phone = new Phone();
        $phone
            ->setBrand('Apple')
            ->setModel('iPhone 11 Pro Max')
            ->setColor('Midnight Green')
            ->setDescription(
                'Capabilities of this iPhone are such that it is the first 
                to earn the Pro designation ! And he deserves it !'
            )
            ->setPrice(1658.99)
        ;
        $manager->persist($phone);

        $phone = new Phone();
        $phone
            ->setBrand('Samsung')
            ->setModel('Galaxy S20 Ultra 5G')
            ->setColor('Cosmic Black')
            ->setDescription(
                'Forget old smartphones, the new photo revolution has arrived !'
            )
            ->setPrice(1558.99)
        ;
        $manager->persist($phone);

        $phone = new Phone();
        $phone
            ->setBrand('Samsung')
            ->setModel('Galaxy S20 Ultra 5G')
            ->setColor('Cloud Pink')
            ->setDescription(
                'Forget old smartphones, the new photo revolution has arrived !'
            )
            ->setPrice(1358.99)
        ;
        $manager->persist($phone);

        $phone = new Phone();
        $phone
            ->setBrand('PhoneToPhone Like a Panda')
            ->setModel('Universe Ultra Lux Max Pro 8G')
            ->setColor('Rough Diamond')
            ->setDescription(
                'Finally a smartphone that knows that its primary function 
                is to make calls before everything else !'
            )
            ->setPrice(2499.99)
        ;
        $manager->persist($phone);

        $manager->flush();
    }
}
