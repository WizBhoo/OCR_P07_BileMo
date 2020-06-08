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
     * An array that represents data samples to load.
     *
     * @var array[]
     */
    private $samples = [
        [
            'Apple',
            'iPhone 11 Pro Max',
            'Gold',
            'Capabilities of this iPhone are such that it is 
            the first to earn the Pro designation ! And he deserves it !',
            1658.99
        ],
        [
            'Apple',
            'iPhone 11 Pro Max',
            'Midnight Green',
            'Capabilities of this iPhone are such that it is 
            the first to earn the Pro designation ! And he deserves it !',
            1658.99
        ],
        [
            'Samsung',
            'Galaxy S20 Ultra 5G',
            'Cosmic Black',
            'Forget old smartphones, the new photo revolution has arrived !',
            1558.99
        ],
        [
            'Samsung',
            'Galaxy S20 Ultra 5G',
            'Cloud Pink',
            'Forget old smartphones, the new photo revolution has arrived !',
            1358.99
        ],
        [
            'PhoneToPhone Like a Panda',
            'Universe Ultra Lux Max Pro 8G',
            'Rough Diamond',
            'Finally a smartphone that knows that its primary 
            function is to make calls before everything else !',
            2499.99
        ],
    ];

    /**
     * Load fixtures in Phone table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->samples as $key => $sample) {
            $phone = new Phone();
            $phone
                ->setBrand($sample[0])
                ->setModel($sample[1])
                ->setColor($sample[2])
                ->setDescription($sample[3])
                ->setPrice($sample[4])
            ;
            $manager->persist($phone);
        }

        $manager->flush();
    }
}
