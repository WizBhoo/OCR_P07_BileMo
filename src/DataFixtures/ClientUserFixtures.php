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
     * Load fixtures in ClientUser table.
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $clientUser = new ClientUser();
        $clientUser
            ->setName('Jean TENDBIEN')
            ->setUsername('The Listener')
            ->setEmail('jeantendbien@bubble.com')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Marie SMARTPHONE')
            ->setUsername('Pink Lady')
            ->setEmail('marie.smartphone@bubble.com')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Paul TALKER')
            ->setUsername('Fast Caller')
            ->setEmail('paul-talker@bubble.com')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Jacques ADIT')
            ->setUsername('DIY')
            ->setEmail('jacques.adit@lovely-panda.fr')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Tom BALEAU')
            ->setUsername('The Waterproof')
            ->setEmail('tombaleau@lovely-panda.fr')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Iphigénie FILAIRE')
            ->setUsername('WifiGenius')
            ->setEmail('iphigenie.filaire@lovely-panda.fr')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Ray ZO')
            ->setUsername('The Connected')
            ->setEmail('ray-zo@lovely-panda.fr')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Eva PASCAPTER')
            ->setUsername('Star 5G')
            ->setEmail('eva.pascapter@phonephone.call')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Sarah CROCHE')
            ->setUsername('Say Allo')
            ->setEmail('sarah-croche@phonephone.call')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($clientUser);

        $clientUser = new ClientUser();
        $clientUser
            ->setName('Ella PLUDBATRIE')
            ->setUsername('Socket Finder')
            ->setEmail('ella-plusbatrie@phonephone.call')
            ->setClient(
                $this->getReference(ClientFixtures::CLIENT_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($clientUser);

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
