<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\ClientUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ClientUserFixtures.
 */
class ClientUserFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * An array that represents data samples to load.
     *
     * @var array[]
     */
    private $samples = [
        [
            'Jean TENDBIEN',
            'The Listener',
            'jeantendbien@bubble.com',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'1'
        ],
        [
            'Marie SMARTPHONE',
            'Pink Lady',
            'marie.smartphone@bubble.com',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'1'
        ],
        [
            'Paul TALKER',
            'Fast Caller',
            'paul-talker@bubble.com',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'1'
        ],
        [
            'Jacques ADIT',
            'DIY',
            'jacques.adit@lovely-panda.fr',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'2'
        ],
        [
            'Tom BALEAU',
            'The Waterproof',
            'tombaleau@lovely-panda.fr',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'2'
        ],
        [
            'Iphigénie FILAIRE',
            'WifiGenius',
            'iphigenie.filaire@lovely-panda.fr',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'2'
        ],
        [
            'Ray ZO',
            'The Connected',
            'ray-zo@lovely-panda.fr',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'2'
        ],
        [
            'Eva PASCAPTER',
            'Star 5G',
            'eva.pascapter@phonephone.call',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'3'
        ],
        [
            'Sarah CROCHE',
            'Say Allo',
            'sarah-croche@phonephone.call',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'3'
        ],
        [
            'Ella PLUDBATRIE',
            'Socket Finder',
            'ella-plusbatrie@phonephone.call',
            ClientFixtures::CLIENT_REFERENCE_PREFIX.'3'
        ],
    ];

    /**
     * Load fixtures in ClientUser table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->samples as $key => $sample) {
            $clientUser = new ClientUser();
            $clientUser
                ->setName($sample[0])
                ->setUsername($sample[1])
                ->setEmail($sample[2])
                ->setClient(
                    $this->getReference($sample[3])
                );
            ;
            $manager->persist($clientUser);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [ClientFixtures::class];
    }
}
