<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Unit\Entity;

use App\Entity\Client;
use App\Entity\ClientUser;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest.
 */
class ClientTest extends TestCase
{
    /**
     * A constant that represent a client name
     *
     * @var string
     */
    const CLIENT_NAME = 'BileMo';

    /**
     * A constant that represent a client email
     *
     * @var string
     */
    const CLIENT_EMAIL = 'contact@bilemo.fr';

    /**
     * Test Client entity getters and setters.
     *
     * @return void
     */
    public function testGetterSetter(): void
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals(null, $client->getId());
        $this->assertEquals(null, $client->getName());
        $this->assertEquals(null, $client->getEmail());
        $this->assertInstanceOf(Collection::class, $client->getClientUsers());

        $client->setName(self::CLIENT_NAME);
        $this->assertEquals(self::CLIENT_NAME, $client->getName());
        $client->setEmail(self::CLIENT_EMAIL);
        $this->assertEquals(self::CLIENT_EMAIL, $client->getEmail());

        $clientUser = new ClientUser();
        $client->addClientUser($clientUser);
        $this->assertCount(1, $client->getClientUsers());

        $client->removeClientUser($clientUser);
        $this->assertCount(0, $client->getClientUsers());
    }
}
