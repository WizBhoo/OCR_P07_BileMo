<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ClientFixtures.
 */
class ClientFixtures extends Fixture
{
    /**
     * A prefix reference constant for Client.
     *
     * @var string
     */
    public const CLIENT_REFERENCE_PREFIX = 'client_';

    /**
     * Load fixtures in Client table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client
            ->setName('Bubble PhoneShop')
            ->setEmail('contact@bubble.com')
        ;
        $manager->persist($client);
        $this->addReference(self::CLIENT_REFERENCE_PREFIX.'1', $client);

        $client = new Client();
        $client
            ->setName('PandaKing Smartphone')
            ->setEmail('contact@lovely-panda.fr')
        ;
        $manager->persist($client);
        $this->addReference(self::CLIENT_REFERENCE_PREFIX.'2', $client);

        $client = new Client();
        $client
            ->setName('PhonePhone Palace')
            ->setEmail('contact@phonephone.call')
        ;
        $manager->persist($client);
        $this->addReference(self::CLIENT_REFERENCE_PREFIX.'3', $client);

        $manager->flush();
    }
}
