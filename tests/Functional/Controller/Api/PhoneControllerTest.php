<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PhoneControllerTest.
 */
class PhoneControllerTest extends WebTestCase
{
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
     * Test get the phones list
     *
     * @return void
     */
    public function testGetPhonesList(): void
    {
        $client = static::createClient();
        $client->request('GET', self::PHONES_LIST_URI);

        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertCount(5, $content);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Test get details of an existing phone
     *
     * @return void
     */
    public function testGetExistingPhone(): void
    {
        $client = static::createClient();
        $client->request('GET', self::PHONES_LIST_URI.'/3');

        $content = $client->getResponse()->getContent();
        $content = json_decode($content, true);
        $this->assertArrayHasKey('brand', $content);
        $this->assertArrayHasKey('model', $content);
        $this->assertArrayHasKey('color', $content);
        $this->assertArrayHasKey('description', $content);
        $this->assertArrayHasKey('price', $content);
        $this->assertArrayNotHasKey('email', $content);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    /**
     * Test get details of a phone that does not exist
     *
     * @return void
     */
    public function testGetWrongPhone(): void
    {
        $client = static::createClient();
        $client->request('GET', self::PHONES_LIST_URI.'/'.self::PHONE_ID);

        $this->assertSame(Response::HTTP_NOT_FOUND, $client->getResponse()->getStatusCode());
    }
}
