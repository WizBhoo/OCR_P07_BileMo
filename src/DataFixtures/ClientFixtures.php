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
     * An array that represents data samples to load.
     *
     * @var array[]
     */
    private $samples = [
        ['Bubble PhoneShop', 'contact@bubble.com'],
        ['PandaKing Smartphone', 'contact@lovely-panda.fr'],
        ['PhonePhone Palace', 'contact@phonephone.call'],
    ];

    /**
     * Load fixtures in Client table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->samples as $key => $sample) {
            $client = new Client();
            $client
                ->setName($sample[0])
                ->setEmail($sample[1])
            ;
            $manager->persist($client);
            $this->addReference(
                self::CLIENT_REFERENCE_PREFIX.($key + 1),
                $client
            );
        }

        $manager->flush();
    }
}
