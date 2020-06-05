<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Unit\Entity;

use App\Entity\Client;
use App\Entity\ClientUser;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientUser.
 */
class ClientUserTest extends TestCase
{
    /**
     * A constant that represent a user name
     *
     * @var string
     */
    const USER_NAME = 'Rui Teixera';

    /**
     * A constant that represent a user username
     *
     * @var string
     */
    const USER_USERNAME = 'Rui';

    /**
     * A constant that represent a user email
     *
     * @var string
     */
    const USER_EMAIL = 'ruiteix@prmaster.fr';

    /**
     * Test ClientUser entity getters and setters.
     *
     * @return void
     */
    public function testGetterSetter(): void
    {
        $clientUser = new ClientUser();

        $this->assertInstanceOf(ClientUser::class, $clientUser);
        $this->assertEquals(null, $clientUser->getId());
        $this->assertEquals(null, $clientUser->getName());
        $this->assertEquals(null, $clientUser->getUsername());
        $this->assertEquals(null, $clientUser->getEmail());
        $this->assertEquals(null, $clientUser->getClient());

        $clientUser->setName(self::USER_NAME);
        $this->assertEquals(self::USER_NAME, $clientUser->getName());
        $clientUser->setUsername(self::USER_USERNAME);
        $this->assertEquals(self::USER_USERNAME, $clientUser->getUsername());
        $clientUser->setEmail(self::USER_EMAIL);
        $this->assertEquals(self::USER_EMAIL, $clientUser->getEmail());

        $client = new Client();
        $clientUser->setClient($client);
        $this->assertEquals($client, $clientUser->getClient());
    }
}
