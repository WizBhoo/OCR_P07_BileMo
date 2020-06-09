<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClientControllerTest.
 */
class ClientControllerTest extends WebTestCase
{
    /**
     * A constant that represent a tested URI
     *
     * @var string
     */
    const USERS_LIST_URI = '/api/clients/'.self::CLIENT_ID.'/users';

    /**
     * A constant that represent a client
     *
     * @var int
     */
    const CLIENT_ID = 2;

    /**
     * A constant that represent a user who belongs to the Client 2
     *
     * @var int
     */
    const USER_ID = 4;

    /**
     * A constant that represent a user that does not belong to the Client 2
     *
     * @var int
     */
    const BAD_USER_ID = 9;

    /**
     * Test get users who belong to a client
     *
     * @return void
     */
    public function testGetUsersList(): void
    {
        $client = static::createClient();
        $client->request('GET', self::USERS_LIST_URI);

        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);

        $this->assertCount(4, $content);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Test get details of an existing user who belongs to a client
     *
     * @return void
     */
    public function testGetExistingUser(): void
    {
        $client = static::createClient();
        $client->request('GET', self::USERS_LIST_URI.'/'.self::USER_ID);

        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('username', $content);
        $this->assertArrayHasKey('email', $content);
        $this->assertArrayNotHasKey('color', $content);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Test get details of a user who does not belong to a client
     *
     * @return void
     */
    public function testGetWrongUser(): void
    {
        $client = static::createClient();
        $client->request('GET', self::USERS_LIST_URI.'/'.self::BAD_USER_ID);

        $this->assertSame(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());
    }
}
