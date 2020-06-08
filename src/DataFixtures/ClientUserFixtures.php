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
        ['Jean TENDBIEN', 'The Listener', 'jeantendbien@bubble.com'],
        ['Marie SMARTPHONE', 'Pink Lady', 'marie.smartphone@bubble.com'],
        ['Paul TALKER', 'Fast Caller', 'paul-talker@bubble.com'],
        ['Jacques ADIT', 'DIY', 'jacques.adit@lovely-panda.fr'],
        ['Tom BALEAU', 'The Waterproof', 'tombaleau@lovely-panda.fr'],
        ['Iphigénie FILAIRE', 'WifiGenius', 'iphigenie.filaire@lovely-panda.fr'],
        ['Ray ZO', 'The Connected', 'ray-zo@lovely-panda.fr'],
        ['Eva PASCAPTER', 'Star 5G', 'eva.pascapter@phonephone.call'],
        ['Sarah CROCHE', 'Say Allo', 'sarah-croche@phonephone.call'],
        ['Ella PLUDBATRIE', 'Socket Finder', 'ella-plusbatrie@phonephone.call'],
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
            ;
            if ($key <= 2) {
                $clientUser->setClient(
                    $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'1')
                );
            } elseif ($key > 2 && $key <=6 ) {
                $clientUser->setClient(
                    $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'2')
                );
            } elseif ($key > 6) {
                $clientUser->setClient(
                    $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'3')
                );
            }
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
