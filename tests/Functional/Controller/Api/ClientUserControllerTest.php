<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Controller\Api;

use App\Tests\Functional\AuthenticationTrait;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClientUserControllerTest.
 */
class ClientUserControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * A constant that represent a tested URI.
     *
     * @var string
     */
    const USERS_LIST_URI = '/api/clients/'.self::CLIENT_ID.'/users';

    /**
     * A constant that represent a client.
     *
     * @var int
     */
    const CLIENT_ID = 2;

    /**
     * A constant that represent a user who belongs to the Client 2.
     *
     * @var int
     */
    const USER_ID = 4;

    /**
     * A constant that represent a user that does not belong to the Client 2.
     *
     * @var int
     */
    const BAD_USER_ID = 9;

    /**
     * An ORM EntityManager Instance.
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Set up a client for test and the EntityManager.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = $this->createClient(['environment' => 'test']);
        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->entityManager->beginTransaction();
    }

    /**
     * Test get users who belong to a client.
     *
     * @return void
     */
    public function testGetUsersList(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'GET',
            self::USERS_LIST_URI
        );

        $content = $this->client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertCount(4, $content['items']);
        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test get users who does not belong to client requester (bad token).
     *
     * @return void
     */
    public function testGetUsersBadToken(): void
    {
        $this->requestAuthenticated(
            'contact@bubble.com',
            'GET',
            self::USERS_LIST_URI
        );

        $this->assertSame(
            Response::HTTP_FORBIDDEN,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test get details of an existing user who belongs to a client.
     *
     * @return void
     */
    public function testGetExistingUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'GET',
            self::USERS_LIST_URI.'/'.self::USER_ID
        );

        $content = $this->client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertArrayHasKey('name', $content);
        $this->assertArrayHasKey('username', $content);
        $this->assertArrayHasKey('email', $content);
        $this->assertArrayNotHasKey('color', $content);
        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test get details of a user who does not belong to a client.
     *
     * @return void
     */
    public function testGetWrongUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'GET',
            self::USERS_LIST_URI.'/'.self::BAD_USER_ID
        );

        $this->assertSame(
            Response::HTTP_FORBIDDEN,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test post to create a new user who belong to a client.
     *
     * @return void
     */
    public function testPostUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'POST',
            self::USERS_LIST_URI,
            [
                "name" => "Ja TEST",
                "username" => "The Guinea Pig",
                "email" => "ja.test@lovely-panda.fr"
            ]
        );

        $content = $this->client->getResponse()->getContent();
        $this->assertJson($content);
        $this->assertSame(
            Response::HTTP_CREATED,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test post to create a new user who does not belong to a client requester (bad token).
     *
     * @return void
     */
    public function testPostUserBadToken(): void
    {
        $this->requestAuthenticated(
            'contact@bubble.com',
            'POST',
            self::USERS_LIST_URI,
            [
                "name" => "Ja TEST",
                "username" => "The Guinea Pig",
                "email" => "ja.test@lovely-panda.fr"
            ]
        );

        $this->assertSame(
            Response::HTTP_FORBIDDEN,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test violations when trying to create a user who belong to a client.
     *
     * @return void
     */
    public function testPostInvalidUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'POST',
            self::USERS_LIST_URI,
            [
                "name" => "Bad User",
                "username" => "KO",
                "email" => "bad.user@violations.com"
            ]
        );

        $content = $this->client->getResponse()->getContent();
        $this->assertJson($content);
        $content = json_decode($content, true);
        $this->assertArrayHasKey('message', $content);
        $this->assertSame(
            Response::HTTP_BAD_REQUEST,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test delete of an existing user who belongs to a client.
     *
     * @return void
     */
    public function testDeleteExistingUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'DELETE',
            self::USERS_LIST_URI.'/'.self::USER_ID
        );

        $this->assertSame(
            Response::HTTP_NO_CONTENT,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test delete of a user who does not belong to a client.
     *
     * @return void
     */
    public function testDeleteWrongUser(): void
    {
        $this->requestAuthenticated(
            'contact@lovely-panda.fr',
            'DELETE',
            self::USERS_LIST_URI.'/'.self::BAD_USER_ID
        );

        $this->assertSame(
            Response::HTTP_FORBIDDEN,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Called after each test using entityManager to avoid memory leaks.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
