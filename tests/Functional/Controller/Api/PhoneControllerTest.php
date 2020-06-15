<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Controller\Api;

use App\Tests\Functional\AuthenticationTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PhoneControllerTest.
 */
class PhoneControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * A constant that represent a tested URI
     *
     * @var string
     */
    const PHONES_LIST_URI = '/api/phones';

    /**
     * A constant that represent a phone that does not exist
     *
     * @var int
     */
    const PHONE_ID = 50;

    /**
     * Set up a client for test and the EntityManager
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = $this->createClient(['environment' => 'test']);
    }

    /**
     * Test get the phones list
     *
     * @return void
     */
    public function testGetPhonesList(): void
    {
        $this->requestAuthenticated(
            'contact@bubble.com',
            'GET',
            self::PHONES_LIST_URI
        );

        $content = $this->client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertCount(5, $content);
        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test get details of an existing phone
     *
     * @return void
     */
    public function testGetExistingPhone(): void
    {
        $this->requestAuthenticated(
            'contact@bubble.com',
            'GET',
            self::PHONES_LIST_URI.'/3'
        );

        $content = $this->client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertArrayHasKey('brand', $content);
        $this->assertArrayHasKey('model', $content);
        $this->assertArrayHasKey('color', $content);
        $this->assertArrayHasKey('description', $content);
        $this->assertArrayHasKey('price', $content);
        $this->assertArrayNotHasKey('email', $content);
        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test get details of a phone that does not exist
     *
     * @return void
     */
    public function testGetWrongPhone(): void
    {
        $this->requestAuthenticated(
            'contact@bubble.com',
            'GET',
            self::PHONES_LIST_URI.'/'.self::PHONE_ID
        );

        $this->assertSame(
            Response::HTTP_NOT_FOUND,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
